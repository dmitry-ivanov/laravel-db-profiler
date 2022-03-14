<?php

namespace Illuminated\Database\Tests;

use Illuminate\Support\Facades\Request;

class HttpProfilingTest extends TestCase
{
    /**
     * Define whether the app is running in console or not.
     */
    protected function runningInConsole(): bool
    {
        return false;
    }

    /**
     * Emulate the "vvv" flag set.
     */
    protected function withVvv(): self
    {
        Request::merge(['vvv' => true]);

        return $this;
    }

    /** @test */
    public function it_is_disabled_if_environment_is_not_local()
    {
        $this->notLocal()->boot();

        $this->assertDbProfilerNotActivated();
    }

    /** @test */
    public function it_is_disabled_if_environment_is_local_but_there_is_no_vvv_request_param()
    {
        $this->local()->boot();

        $this->assertDbProfilerNotActivated();
    }

    /** @test */
    public function it_is_enabled_if_environment_is_local_and_there_is_vvv_request_param()
    {
        $this->local()->withVvv()->boot();

        $this->assertDbProfilerActivated();
        $this->assertDbQueriesDumped();
    }
}
