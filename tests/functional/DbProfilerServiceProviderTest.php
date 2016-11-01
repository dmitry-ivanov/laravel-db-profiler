<?php

class DbProfilerServiceProviderTest extends TestCase
{
    /** @test */
    public function it_successfully_loaded_routes_from_fixture()
    {
        $this->visit('/');
        $this->see('Hello World!');
    }

    /** @test */
    public function it_successfully_loaded_routes_from_fixture_second_test()
    {
        $this->visit('/');
        $this->see('Hello World!');
    }
}
