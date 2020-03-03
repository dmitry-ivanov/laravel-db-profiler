<?php

namespace Illuminated\Database\Tests;

use Illuminate\Support\Facades\Request;

class HttpProfilingTest extends TestCase
{
    /**
     * Define whether the app is running in console or not.
     *
     * @return bool
     */
    protected function runningInConsole()
    {
        return false;
    }

    /**
     * Emulate the "vvv" flag set.
     *
     * @return $this
     */
    protected function withVvv()
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
