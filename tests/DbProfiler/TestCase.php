<?php

namespace Illuminated\Database\DbProfiler\Tests;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminated\Database\DbProfilerServiceProvider;
use Illuminated\Testing\TestingTools;
use Mockery;
use Post;

Mockery::globalHelpers();

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    private $env;
    private $eventName;

    public function setUp()
    {
        parent::setUp();

        $this->setUpEventName();
        $this->setUpDatabase();
    }

    private function setUpEventName()
    {
        $this->eventName = QueryExecuted::class;
    }

    private function setUpDatabase()
    {
        config(['database.default' => 'testing']);

        DB::statement('PRAGMA foreign_keys = ON');

        $this->artisan('migrate', [
            '--database' => 'testing',
            '--path' => relative_path(__DIR__, base_path()) . '/fixture/database/migrations/',
        ]);
        $this->seeInArtisanOutput('Migrated');
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
        $app = mock(Application::class);
        $app->expects()->isLocal()->andReturn($this->env == 'local');
        $app->allows()->runningInConsole()->andReturn($this->runningInConsole());

        $provider = new DbProfilerServiceProvider($app);
        $provider->boot();
    }

    protected function assertDbProfilerActivated()
    {
        $this->assertTrue(DB::getEventDispatcher()->hasListeners($this->eventName));
    }

    protected function assertDbProfilerNotActivated()
    {
        $this->assertFalse(DB::getEventDispatcher()->hasListeners($this->eventName));
    }

    protected function assertDbQueriesDumped()
    {
        $queries = [
            '[1]: select * from "posts"',
            '[2]: select * from "posts" where "posts"."id" = 1 limit 1',
            '[3]: select * from "posts" where "posts"."id" = \'2\' limit 1',
            '[4]: select * from "posts" where "is_enabled" = 1',
            '[5]: select * from "posts" where "is_enabled" = 1',
            '[6]: select * from "posts" where "is_enabled" = \'1\'',
            '[7]: select * from "posts" where "id" > 3 and "title" = \'test\' and "created_at" > \'2016-11-03 21:00:00\' limit 1',
        ];

        $mock = mock('alias:Symfony\Component\VarDumper\VarDumper');
        foreach ($queries as $query) {
            $arg = $this->prepareQueryPattern($query);
            $mock->expects()->dump(Mockery::pattern($arg));
        }

        Post::all();
        Post::find(1);
        Post::find('2');
        Post::where('is_enabled', true)->get();
        Post::where('is_enabled', 1)->get();
        Post::where('is_enabled', '1')->get();
        Post::where('id', '>', 3)->where('title', 'test')->where('created_at', '>', '2016-11-03 21:00:00')->first();
    }

    private function prepareQueryPattern($query)
    {
        $pattern = preg_quote($query, '/');
        return "/{$pattern}; (.*? ms)/";
    }

    public function tearDown()
    {
        $dispatcher = DB::getEventDispatcher();
        if ($dispatcher->hasListeners($this->eventName)) {
            $dispatcher->forget($this->eventName);
        }

        parent::tearDown();
    }
}
