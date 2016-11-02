<?php

class HttpProfilingTest extends TestCase
{
    /** @test */
    public function it_is_disabled_for_non_local_environments()
    {
        $this->assertFalse($this->app->isLocal());
        $this->visit('/');

        $this->see('Home page!');
        $this->dontSee('select * from posts');
    }

    /** @test */
    public function it_is_disabled_for_non_local_environments_even_if_vvv_request_param_is_set()
    {
        $this->assertFalse($this->app->isLocal());
        $this->visit('/?vvv');

        $this->see('Home page!');
        $this->dontSee('select * from posts');
    }

    /** @test */
    public function it_is_disabled_for_local_environment_if_no_vvv_request_param_was_set()
    {
        // $this->assertTrue($this->app->isLocal());
        // $this->visit('/');
        //
        // $this->see('Home page!');
        // $this->dontSee('select * from posts');
    }

    /** @test */
    public function it_is_enabled_for_local_environment_if_vvv_request_param_is_set()
    {
        // $this->assertTrue($this->app->isLocal());
        // $this->visit('/?vvv')->dump();
        //
        // $this->see('Home page!');
        // $this->see('select * from posts');
    }
}
