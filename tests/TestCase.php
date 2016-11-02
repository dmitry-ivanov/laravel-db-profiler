<?php

use Illuminate\Foundation\Application;
use Illuminated\Database\DbProfilerServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders(Application $app)
    {
        return [DbProfilerServiceProvider::class];
    }

    protected function getEnvironmentSetUp(Application $app)
    {
        $this->setUpRoutes();
    }

    private function setUpRoutes()
    {
        require 'fixture/routes/web.php';
    }
}
