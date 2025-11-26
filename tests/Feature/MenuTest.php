<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_items(): void
    {
        $response = $this->get('/menu');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonPath('0.children.0.name', 'Laracon')
            ->assertJsonPath('0.children.0.children.0.url', '/events/laracon/workshops/illuminate')
            ->assertJsonPath('0.children.0.children.1.url', '/events/laracon/workshops/eloquent')
            ->assertJsonPath('0.children.1.name', 'Reactcon')
            ->assertJsonPath('0.children.1.children.0.url', '/events/reactcon/workshops/noclass')
            ->assertJsonPath('0.children.1.children.1.url', '/events/reactcon/workshops/jungle');
    }
}
