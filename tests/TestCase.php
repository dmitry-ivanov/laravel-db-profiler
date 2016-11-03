<?php

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $this->setUpDatabase();
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

    private function setUpFactories()
    {
        $this->withFactories(__DIR__ . '/fixture/database/factories');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => __DIR__ . '/fixture/database/migrations',
        ]);
    }

    private function seedDatabase()
    {
        factory(Post::class, 10)->create();
    }
}
