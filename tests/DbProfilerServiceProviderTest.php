<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminated\Database\DbProfilerServiceProvider;

class DbProfilerServiceProviderTest extends TestCase
{
    /** @test */
    public function it_is_disabled_if_environment_is_not_local()
    {
        $app = Mockery::mock(Application::class);
        $app->shouldReceive('isLocal')->once()->withNoArgs()->andReturn(false);

        $provider = new DbProfilerServiceProvider($app);
        $provider->boot();

        $this->assertDatabaseQueriesAreNotListened();
    }
}
