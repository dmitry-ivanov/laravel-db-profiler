<?php

class ConsoleProfilingTest extends TestCase
{
    protected function runningInConsole()
    {
        return true;
    }

    protected function withVvv()
    {
        $_SERVER['argv']['-vvv'] = true;
        return $this;
    }

    /** @test */
    public function it_is_disabled_if_environment_is_not_local()
    {
        $this->notLocal()->boot();
        $this->assertDbProfilerIsNotActivated();
    }

    /** @test */
    public function it_is_disabled_if_environment_is_local_but_there_is_no_vvv_option()
    {
        $this->local()->boot();
        $this->assertDbProfilerIsNotActivated();
    }

    /** @test */
    public function it_is_enabled_if_environment_is_local_and_there_is_vvv_option()
    {
        $this->local()->withVvv()->boot();
        $this->assertDbProfilerIsActivated();
    }

    /** @test */
    public function it_dumps_all_database_queries_with_applied_bindings()
    {
        $this->local()->withVvv()->boot();
        $this->assertDatabaseQueriesAreDumped();
    }
}
