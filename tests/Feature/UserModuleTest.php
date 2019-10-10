<?php

namespace Tests\Feature;

use App\Model\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    function it_create_a_new_user()
    {
        $this->post(route('users.store'), [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin',
            'password' => 'secreto1'
        ])->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin'
        ]);
    }

    /** @test */
    function the_name_is_required()
    {

        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => '',
            'email' => 'erichbriceno@gmail.com',
            'password' => 'secreto1',
            'role' => 'admin',
        ])->assertRedirect(route('users.create'))
        ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function the_email_is_required()
    {

        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Erich',
            'email' => '',
            'password' => 'secreto1',
            'role' => 'admin',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
        ]);

    }

    /** @test */
    function the_role_is_required()
    {

        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'password' => 'secreto1',
            'role' => '',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['role' => 'El campo role es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function the_password_is_required()
    {

        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'password' => '',
            'role' => 'admin',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password' => 'El campo password es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function it_loads_the_edit_user_page()
    {
        $user = factory(User::class)->create();

        $this->get(route('user.edit', ['user' => $user]))
            ->assertStatus(200)
            ->assertViewIs('user.edit')
            ->assertSee('EDITAR USUARIO')
            ->assertViewHas('user', $user);
    }

    /** @test */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();

        $this->put(route('user.update', ['user' => $user]), [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin',
            'password' => 'secreto1'
        ])->assertRedirect(route('user.details',['user' => $user]));

        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {

        $user = factory(User::class)->create();

        $this->from(route('user.edit', ['user' => $user]))
            ->put(route('user.update', ['user' => $user]), [
            'name' => '',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin',
            'password' => 'secreto1'
        ])
        ->assertRedirect(route('user.edit', ['user' => $user]))
        ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['name' => 'erichbriceno@gmail.com']);
    }

    /** @test */
    function the_email_must_be_valid_when_updating_a_user()
    {

        $user = factory(User::class)->create();

        $this->from(route('user.edit', ['user' => $user]))
            ->put(route('user.update', ['user' => $user]), [
                'name' => 'Erich',
                'email' => 'correo-no-valido',
                'role' => 'admin',
                'password' => 'secreto1'
            ])
            ->assertRedirect(route('user.edit', ['user' => $user]))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['name' => 'Erich']);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user()
    {

        $oldPassword = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from(route('user.edit', ['user' => $user]))
            ->put(route('user.update', ['user' => $user]), [
                'name' => 'Erich',
                'email' => 'erichbriceno@gmail.com',
                'role' => 'admin',
                'password' => ''
            ])
            ->assertRedirect(route('user.details', ['user' => $user]));


        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin',
            //'password' => $oldPassword
        ]);
    }

    /** @test */
    function the_email_must_be_unique_when_updating_a_user()
    {

        factory(User::class)->create([
            'email' => 'existing-email@example.com'
        ]);

        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com'
        ]);

        $this->from(route('user.edit', ['user' => $user]))
            ->put(route('user.update', ['user' => $user]), [
                'name' => 'Erich',
                'email' => 'existing-email@example.com',
                'role' => 'admin',
                'password' => 'secreto1'
            ])
            ->assertRedirect(route('user.edit', ['user' => $user]))
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function the_users_email_can_stay_the_same_when_updating_a_user()
    {

        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com'
        ]);

        $this->from(route('user.edit', ['user' => $user]))
            ->put(route('user.update', ['user' => $user]), [
                'name' => 'Erich',
                'email' => 'erichbriceno@gmail.com',
                'role' => 'admin',
                'password' => 'secreto1'
            ])
            ->assertRedirect(route('user.details', ['user' => $user]));

        $this->assertEquals(1, User::count());
        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'admin',
        ]);
    }

}
