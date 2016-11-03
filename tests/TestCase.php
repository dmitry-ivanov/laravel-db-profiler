<?php

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Application;
use Illuminated\Database\DbProfilerServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    private $env;

    protected function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
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

    public function assertDatabaseQueriesAreListened()
    {
        $this->assertTrue(DB::getEventDispatcher()->hasListeners(QueryExecuted::class));
    }

    public function assertDatabaseQueriesAreNotListened()
    {
        $this->assertFalse(DB::getEventDispatcher()->hasListeners(QueryExecuted::class));
    }

    protected function local()
    {
        $this->env = 'local';
        return $this;
    }

    protected function notLocal()
    {
        $this->env = 'production';
        return $this;
    }

    abstract protected function runningInConsole();

    abstract protected function withVvv();

    protected function boot()
    {
        $app = Mockery::mock(Application::class);
        $app->shouldReceive('isLocal')->once()->withNoArgs()->andReturn(($this->env == 'local'));
        $app->shouldReceive('runningInConsole')->zeroOrMoreTimes()->withNoArgs()->andReturn($this->runningInConsole());

        $provider = new DbProfilerServiceProvider($app);
        $provider->boot();
    }
}
