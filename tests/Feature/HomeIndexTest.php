<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeIndexTest extends TestCase
{
    public function test_home_page_loads_successfully(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('DUDU TECH');
    }
}
