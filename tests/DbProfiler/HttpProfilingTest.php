<?php

namespace Illuminated\Database\DbProfiler\Tests;

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
    }

    /** @test */
    public function it_dumps_all_database_queries_with_applied_bindings()
    {
        $this->local()->withVvv()->boot();
        $this->assertDbQueriesDumped();
    }
}
