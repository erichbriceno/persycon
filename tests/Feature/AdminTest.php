<?php

namespace Tests\Feature;


use App\Model\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_authorizer_admin_can_see_the_menu()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'Erich Briceno',
            'email' => 'erichbriceno@gmail.com',
            'password' => bcrypt('secreto1'),
            'role' => 'admin'
        ]);

        $this->actingAs($user);

        $this->get(route('home'))
            ->assertSee('Administración')
            ->assertStatus(200);
    }

    /** @test */
    function when_an_administrator_goes_to_the_project_link_he_can_see_them()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->get(route('projects'))
            ->assertStatus(200)
            ->assertSee('Proyectos');
    }

}
