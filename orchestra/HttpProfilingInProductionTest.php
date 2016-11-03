<?php

class HttpProfilingInProductionTest extends TestCase
{
    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return 'production';
        });
    }

    /** @test */
    public function it_is_disabled_for_production()
    {
        $this->assertEnvironmentEquals('production');
        $this->visit('/');

        $this->see('Home page!');
        $this->dontSee('select * from posts');
    }

    /** @test */
    public function it_is_disabled_for_production_even_if_profiling_was_requested()
    {
        $this->assertEnvironmentEquals('production');
        $this->visit('/?vvv');

        $this->see('Home page!');
        $this->dontSee('select * from posts');
    }
}
