<?php

class HttpProfilingTest extends TestCase
{
    /** @test */
    public function it_is_disabled_if_profiling_was_not_requested()
    {
        $this->assertEnvironmentNotEquals('production');
        $this->visit('/');

        $this->see('Home page!');
        $this->dontSee('select * from posts');
    }

    /** @test */
    public function it_is_enabled_if_profiling_was_requested()
    {
        $this->assertEnvironmentNotEquals('production');
        $this->visit('/?vvv');

        $this->see('Home page!');
        $this->dontSee('select * from posts');
    }
}
