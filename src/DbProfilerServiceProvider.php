<?php

namespace Illuminated\Database;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class DbProfilerServiceProvider extends ServiceProvider
{
    /**
     * The query counter.
     */
    private int $counter = 1;

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/db-profiler.php', 'db-profiler');

        app()->instance('db.idpdumper', new DbProfilerDumper());
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        DB::listen(function (QueryExecuted $query) {
            $i = $this->counter++;
            $sql = $this->applyQueryBindings($query->sql, $query->bindings);
            $time = $query->time;
            app('db.idpdumper')->dump("[{$i}]: {$sql}; ({$time} ms)");
        });
    }

    /**
     * Check whether database profiling is enabled or not.
     */
    private function isEnabled(): bool
    {
        if (!$this->app->isLocal() && !config('db-profiler.force')) {
            return false;
        }

        return $this->app->runningInConsole()
            ? collect($_SERVER['argv'])->contains('-vvv')
            : Request::exists('vvv');
    }

    /**
     * Apply query bindings to the given SQL query.
     */
    private function applyQueryBindings(string $sql, array $bindings): string
    {
        $bindings = collect($bindings)->map(function ($binding) {
            return match (gettype($binding)) {
                'boolean' => (int) $binding,
                'string' => "'{$binding}'",
                default => $binding,
            };
        })->toArray();

        return Str::replaceArray('?', $bindings, $sql);
    }
}
