<?php

namespace Illuminated\Database\Tests;

use Facades\Illuminated\Database\DbProfilerDumper;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminated\Database\DbProfilerServiceProvider;
use Illuminated\Database\Tests\App\Post;
use Illuminated\Testing\TestingTools;
use Mockery;

Mockery::globalHelpers();

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    /**
     * The emulated environment.
     */
    private string $env;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    /**
     * Setup the database.
     */
    private function setUpDatabase(): void
    {
        config(['database.default' => 'testing']);
        config(['database.connections.testing.foreign_key_constraints' => true]);

        $this->artisan('migrate', [
            '--database' => 'testing',
            '--path' => relative_path(__DIR__, base_path()) . '/fixture/database/migrations/',
        ])->assertSuccessful();
    }

    /**
     * Emulate the local environment.
     */
    protected function local(): self
    {
        $this->env = 'local';

        return $this;
    }

    /**
     * Emulate the non-local environment.
     */
    protected function notLocal(): self
    {
        $this->env = 'production';

        return $this;
    }

    /**
     * Define whether the app is running in console or not.
     */
    abstract protected function runningInConsole(): bool;

    /**
     * Emulate the "vvv" flag set.
     */
    abstract protected function withVvv(): self;

    /**
     * Emulate the app boot.
     */
    protected function boot(): void
    {
        $app = mock(Application::class);
        $app->expects('isLocal')->andReturn($this->env == 'local');
        $app->allows('runningInConsole')->andReturn($this->runningInConsole());
        $app->allows('configurationIsCached')->andReturnTrue();

        $serviceProvider = new DbProfilerServiceProvider($app);
        $serviceProvider->register();
        $serviceProvider->boot();
    }

    /**
     * Assert that the database profiler is activated.
     */
    protected function assertDbProfilerActivated(): void
    {
        $connection = DB::connection();
        $dispatcher = $connection->getEventDispatcher();
        $this->assertTrue($dispatcher->hasListeners(QueryExecuted::class));
    }

    /**
     * Assert that the database profiler is not activated.
     */
    protected function assertDbProfilerNotActivated(): void
    {
        $connection = DB::connection();
        $dispatcher = $connection->getEventDispatcher();
        $this->assertFalse($dispatcher->hasListeners(QueryExecuted::class));
    }

    /**
     * Assert that the database queries are dumped.
     */
    protected function assertDbQueriesDumped(): void
    {
        $queries = collect([
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
        ]);

        $queries->each(function (string $query) {
            $queryPattern = $this->prepareQueryPattern($query);
            DbProfilerDumper::shouldReceive('dump')->with(Mockery::pattern($queryPattern));
        });

        Post::all();
        Post::query()->find(1);
        Post::query()->find('2');
        Post::query()->where('title', 'foo bar baz')->get();
        Post::query()->where('price', '>', 123.45)->get();
        Post::query()->where('price', '<', '543.21')->get();
        Post::query()->where('is_enabled', true)->get();
        Post::query()->where('is_enabled', false)->get();
        Post::query()->where('is_enabled', 1)->get();
        Post::query()->where('is_enabled', '1')->get();
        Post::query()->whereIn('id', [1, '2', 3])->get();
        Post::query()->whereIn('title', ['foo', 'bar', 'baz'])->get();
        Post::query()->whereIn('price', [1.23, '2.34', 3.45])->get();
        Post::query()->whereIn('is_enabled', [true, false, 1, 0, '1', '0'])->get();
        Post::query()->where('id', '>', 3)->where('title', 'foo bar baz')->where('price', '>', 123.45)->where('is_enabled', true)->where('created_at', '>', '2016-11-03 21:00:00')->first();
        Post::query()->where('title', null)->get();
        Post::query()->where('title', null)->where('price', '>', 123.45)->get();
    }

    /**
     * Prepare the query pattern for mocking.
     */
    private function prepareQueryPattern(string $query): string
    {
        $query = preg_quote($query, '/');

        return "/{$query}; (.*? ms)/";
    }

    /**
     * Clean up the testing environment before the next test.
     */
    protected function tearDown(): void
    {
        $connection = DB::connection();
        $dispatcher = $connection->getEventDispatcher();

        if ($dispatcher->hasListeners(QueryExecuted::class)) {
            $dispatcher->forget(QueryExecuted::class);
        }

        parent::tearDown();
    }
}
