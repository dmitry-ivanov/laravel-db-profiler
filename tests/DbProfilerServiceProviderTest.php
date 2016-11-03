<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminated\Database\DbProfilerServiceProvider;

class DbProfilerServiceProviderTest extends TestCase
{
    /** @test */
    public function it_zzz()
    {
        $appMock = Mockery::mock(Application::class);
        $appMock->shouldReceive('isLocal')->once()->withNoArgs()->andReturn(false);

        $provider = new DbProfilerServiceProvider($appMock);
        $provider->boot();
    }
}
