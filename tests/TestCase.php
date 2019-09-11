<?php

namespace Illuminated\Database\Tests;

use Mockery;
use Illuminate\Support\Facades\DB;
use Illuminated\Testing\TestingTools;
use Illuminate\Foundation\Application;
use Illuminated\Database\Tests\App\Post;
use Illuminate\Database\Events\QueryExecuted;
use Illuminated\Database\DbProfilerServiceProvider;

Mockery::globalHelpers();

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    public $mockConsoleOutput = false;

    private $env;
    private $eventName;

    protected function setUp(): void
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
            '[4]: select * from "posts" where "title" = \'foo bar baz\'',
            '[5]: select * from "posts" where "price" > 123.45',
            '[6]: select * from "posts" where "price" < \'543.21\'',
            '[7]: select * from "posts" where "is_enabled" = 1',
            '[8]: select * from "posts" where "is_enabled" = 0',
            '[9]: select * from "posts" where "is_enabled" = 1',
            '[10]: select * from "posts" where "is_enabled" = \'1\'',
            '[11]: select * from "posts" where "id" in (1, \'2\', 3)',
            '[12]: select * from "posts" where "title" in (\'foo\', \'bar\', \'baz\')',
            '[13]: select * from "posts" where "price" in (1.23, \'2.34\', 3.45)',
            '[14]: select * from "posts" where "is_enabled" in (1, 0, 1, 0, \'1\', \'0\')',
            '[15]: select * from "posts" where "id" > 3 and "title" = \'foo bar baz\' and "price" > 123.45 and "is_enabled" = 1 and "created_at" > \'2016-11-03 21:00:00\' limit 1',
            '[16]: select * from "posts" where "title" is null',
            '[17]: select * from "posts" where "title" is null and "price" > 123.45',
        ];

        $mock = mock('alias:Symfony\Component\VarDumper\VarDumper');
        foreach ($queries as $query) {
            $arg = $this->prepareQueryPattern($query);
            $mock->expects()->dump(Mockery::pattern($arg));
        }

        Post::all();
        Post::find(1);
        Post::find('2');
        Post::where('title', 'foo bar baz')->get();
        Post::where('price', '>', 123.45)->get();
        Post::where('price', '<', '543.21')->get();
        Post::where('is_enabled', true)->get();
        Post::where('is_enabled', false)->get();
        Post::where('is_enabled', 1)->get();
        Post::where('is_enabled', '1')->get();
        Post::whereIn('id', [1, '2', 3])->get();
        Post::whereIn('title', ['foo', 'bar', 'baz'])->get();
        Post::whereIn('price', [1.23, '2.34', 3.45])->get();
        Post::whereIn('is_enabled', [true, false, 1, 0, '1', '0'])->get();
        Post::where('id', '>', 3)
            ->where('title', 'foo bar baz')
            ->where('price', '>', 123.45)
            ->where('is_enabled', true)
            ->where('created_at', '>', '2016-11-03 21:00:00')
            ->first();
        Post::where('title', null)->get();
        Post::where('title', null)->where('price', '>', 123.45)->get();
    }

    private function prepareQueryPattern($query)
    {
        $pattern = preg_quote($query, '/');
        return "/{$pattern}; (.*? ms)/";
    }

    protected function tearDown(): void
    {
        $dispatcher = DB::getEventDispatcher();
        if ($dispatcher->hasListeners($this->eventName)) {
            $dispatcher->forget($this->eventName);
        }

        parent::tearDown();
    }
}
