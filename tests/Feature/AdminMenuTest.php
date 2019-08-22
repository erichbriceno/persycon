<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminMenuTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_authorizer_admin_can_see_the_menu()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('home'))
            ->assertSee('Administración')
            ->assertStatus(200);
    }
}
