<?php

namespace Illuminated\Database\Tests;

class ConsoleProfilingTest extends TestCase
{
    /**
     * Define whether the app is running in console or not.
     */
    protected function runningInConsole(): bool
    {
        return true;
    }

    /**
     * Emulate the "vvv" flag set.
     */
    protected function withVvv(): self
    {
        $_SERVER['argv']['-vvv'] = true;

        return $this;
    }

    /** @test */
    public function it_is_disabled_if_environment_is_not_local()
    {
        $this->notLocal()->boot();

        $this->assertDbProfilerNotActivated();
    }

    /** @test */
    public function it_is_disabled_if_environment_is_local_but_there_is_no_vvv_option()
    {
        $this->local()->boot();

        $this->assertDbProfilerNotActivated();
    }

    /** @test */
    public function it_is_enabled_if_environment_is_local_and_there_is_vvv_option()
    {
        $this->local()->withVvv()->boot();

        $this->assertDbProfilerActivated();
        $this->assertDbQueriesDumped();
    }

    /** @test */
    public function it_is_enabled_if_environment_is_not_local_but_there_is_a_force_flag_in_config()
    {
        config(['db-profiler.force' => true]);

        $this->notLocal()->withVvv()->boot();

        $this->assertDbProfilerActivated();
        $this->assertDbQueriesDumped();
    }
}
