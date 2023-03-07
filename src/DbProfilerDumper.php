<?php

namespace Illuminated\Database;

class DbProfilerDumper
{
    /**
     * Dump the given query.
     */
    public static function dump(string $query): void
    {
        /** @noinspection ForgottenDebugOutputInspection */
        dump($query);
    }
}
