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

        $user = factory(User::class)->create([
            'name' => 'Erich Briceno',
            'email' => 'erichbriceno@gmail.com',
            'password' => bcrypt('secreto1'),
            'role' => 'master'
        ]);

        $this->actingAs($user);

        $this->get(route('home'))
            ->assertSee('Administración')
            ->assertSee('Personal')
            ->assertSee('Nómina')
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

    /** @test */
    function it_displays_the_users_details()
    {

        $user = factory(User::class)->create([
            'name' => 'Erich Briceno',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'master',
        ]);
        $this->get('/users/'.$user->id)
        ->assertStatus(200)
            ->assertSee('Erich Briceno');
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {

        $this->get('/users/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_show_a_message_when_user_list_its_empty()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');

    }

}
