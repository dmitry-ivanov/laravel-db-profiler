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
        $this->setUpDatabase();
        $this->setUpRoutes();
    }

    protected function setUp()
    {
        parent::setUp();

        $this->setUpFactories();
        $this->loadMigrations();
        $this->seedDatabase();
    }

    private function setUpDatabase()
    {
        config(['database.default' => 'testing']);
    }

    private function setUpRoutes()
    {
        require 'fixture/routes/web.php';
    }

    private function setUpFactories()
    {
        $this->withFactories(__DIR__ . '/fixture/database/factories');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom([
            '--force' => true,
            '--database' => 'testing',
            '--realpath' => __DIR__ . '/fixture/database/migrations',
        ]);
    }

    private function seedDatabase()
    {
        factory(Post::class, 10)->create();
    }

    public function assertEnvironmentEquals($env)
    {
        $this->assertTrue($this->app->environment($env));
    }

    public function assertEnvironmentNotEquals($env)
    {
        $this->assertFalse($this->app->environment($env));
    }
}
