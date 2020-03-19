<?php

namespace Tests\Feature\Admin;

use App\Model\{User, Role};
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_authorizer_admin_can_see_the_menu()
    {
        $user = factory(User::class)->create([
            'role_id' => Role::Where('name', 'User')->first()->id,
        ]);

        $this->actingAs($user);

        $this->get(route('home'))
            ->assertSee('Administración')
            ->assertSee('Personal')
            ->assertSee('Nómina')
            ->assertStatus(200);
    }

 }
