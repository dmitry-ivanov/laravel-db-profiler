<?php

use Illuminated\Database\DbProfilerServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $this->setUpFixture();
        $this->setUpDatabase();
        $this->setUpRoutes();
    }

    protected function getPackageProviders($app)
    {
        return [DbProfilerServiceProvider::class];
    }

    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrations();
    }

    private function setUpFixture()
    {
        require_once 'fixture/app/Post.php';
    }

    private function setUpDatabase()
    {
        config(['database.default' => 'testing']);
    }

    private function setUpRoutes()
    {
        require 'fixture/routes/web.php';
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__ . '/fixture/database/migrations'),
        ]);
    }
}
