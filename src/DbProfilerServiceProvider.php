<?php

namespace Illuminated\Database;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class DbProfilerServiceProvider extends ServiceProvider
{
    private static $counter;

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

        foreach ($bindings as $binding) {
            if (gettype($binding) == 'string') {
                $binding = "'{$binding}'";
            }

            $sql = preg_replace('/\?/', $binding, $sql, 1);
        }

        return $sql;
    }
}
