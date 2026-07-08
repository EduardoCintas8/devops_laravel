<?php

namespace Tests\Feature;

use Livewire\Livewire;
use Tests\TestCase;

class HomeIndexTest extends TestCase
{
    public function test_home_page_loads_successfully(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Como podemos te chamar?');
    }

    public function test_user_can_select_mood(): void
    {
        Livewire::test('home.index')
            ->call('selectMood', 'focado')
            ->assertSet('mood', 'focado');
    }

    public function test_user_can_boost_and_reset(): void
    {
        Livewire::test('home.index')
            ->call('boost')
            ->call('boost')
            ->assertSet('boosts', 2)
            ->call('resetBoost')
            ->assertSet('boosts', 0);
    }

    public function test_typing_name_updates_greeting(): void
    {
        Livewire::test('home.index')
            ->set('name', 'Dudu')
            ->assertSee('Dudu');
    }

    public function test_invalid_mood_is_ignored(): void
    {
        Livewire::test('home.index')
            ->call('selectMood', 'invalido')
            ->assertSet('mood', 'feliz');
    }
}
