<?php

use Illuminated\Database\DbProfilerServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [DbProfilerServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $this->setUpRoutes();
    }

    private function setUpRoutes()
    {
        require 'fixture/routes/web.php';
    }
}
