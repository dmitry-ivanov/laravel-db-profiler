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
     *
     * @var int
     */
    private $counter = 1;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/db-profiler.php', 'db-profiler');
    }

    /**
     * Boot the service provider.
     *
     * @return void
     *
     * @noinspection ForgottenDebugOutputInspection
     */
    public function boot()
    {
        if (!$this->isEnabled()) {
            return;
        }

        DB::listen(function (QueryExecuted $query) {
            $i = $this->counter++;
            $sql = $this->applyQueryBindings($query->sql, $query->bindings);
            $time = $query->time;
            dump("[{$i}]: {$sql}; ({$time} ms)");
        });
    }

    /**
     * Check whether database profiling is enabled or not.
     *
     * @return bool
     */
    private function isEnabled()
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
     *
     * @param string $sql
     * @param array $bindings
     * @return string
     */
    private function applyQueryBindings(string $sql, array $bindings)
    {
        $bindings = collect($bindings)->map(function ($binding) {
            switch (gettype($binding)) {
                case 'boolean':
                    return (int) $binding;
                case 'string':
                    return "'{$binding}'";
                default:
                    return $binding;
            }
        })->toArray();

        return Str::replaceArray('?', $bindings, $sql);
    }
}
