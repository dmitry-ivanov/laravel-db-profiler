<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminated\Database\DbProfilerServiceProvider;

class HttpProfilingTest extends TestCase
{
    /** @test */
    public function it_is_disabled_if_environment_is_not_local()
    {
        $this->initOnNotLocalEnvironment();
        $this->assertDatabaseQueriesAreNotListened();
    }

    /** @test */
    public function it_is_disabled_if_environment_is_local_but_there_is_no_vvv_request_param()
    {
        $this->initOnLocalEnvironment();
        $this->assertDatabaseQueriesAreNotListened();
    }

    private function initOnLocalEnvironment()
    {
        $this->init('local');
    }

    private function initOnNotLocalEnvironment()
    {
        $this->init('production');
    }

    private function init($env)
    {
        $isLocal = ($env == 'local');

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('isLocal')->once()->withNoArgs()->andReturn($isLocal);
        $app->shouldReceive('runningInConsole')->zeroOrMoreTimes()->withNoArgs()->andReturn(false);

        $provider = new DbProfilerServiceProvider($app);
        $provider->boot();
    }
}
