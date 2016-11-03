<?php

class HttpProfilingTest extends TestCase
{
    protected function runningInConsole()
    {
        return false;
    }

    protected function withVvv()
    {
        request()['vvv'] = true;
        return $this;
    }

    /** @test */
    public function it_is_disabled_if_environment_is_not_local()
    {
        $this->notLocal()->boot();
        $this->assertDbProfilerIsNotActivated();
    }

    /** @test */
    public function it_is_disabled_if_environment_is_local_but_there_is_no_vvv_request_param()
    {
        $this->local()->boot();
        $this->assertDbProfilerIsNotActivated();
    }
}
