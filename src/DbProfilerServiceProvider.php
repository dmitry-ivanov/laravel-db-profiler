<?php

namespace Illuminated\Database;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class DbProfilerServiceProvider extends ServiceProvider
{
    private static $counter;

    public function register()
    {
    }

    private static function tickCounter()
    {
        return self::$counter++;
    }

    public function boot()
    {
        if (!$this->isEnabled()) {
            return;
        }

        self::$counter = 1;

        DB::listen(function (QueryExecuted $query) {
            $i = self::tickCounter();
            $sql = $this->applyBindings($query->sql, $query->bindings);
            dump("[$i]: {$sql}; ({$query->time} ms)");
        });
    }

    private function isEnabled()
    {
        if (!config('db-profiler.force') && !$this->app->isLocal()) {
            return false;
        }

        if ($this->app->runningInConsole()) {
            return in_array('-vvv', $_SERVER['argv']);
        }

        return request()->exists('vvv');
    }

    private function applyBindings($sql, array $bindings)
    {
        if (empty($bindings)) {
            return $sql;
        }

        $placeholder = preg_quote('?', '/');
        foreach ($bindings as $binding) {
            $binding = is_numeric($binding) ? $binding : "'{$binding}'";
            $sql = preg_replace('/' . $placeholder . '/', $binding, $sql, 1);
        }

        return $sql;
    }
}
