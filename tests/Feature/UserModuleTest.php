<?php

namespace Tests\Feature;

use App\Model\Role;
use App\Model\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_displays_the_users_details()
    {

        $user = factory(User::class)->create($this->getValidData());

        $this->get(route('user.details', $user))
            ->assertStatus(200)
            ->assertSee('Erich');
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
        $this->post(route('user.store'), $this->getValidData())
            ->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'master'
        ]);
    }

    /** @test */
    function the_name_is_required()
    {

        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'name' => ''
            ]))->assertRedirect(route('user.create'))
        ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function the_email_is_required()
    {

        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
            'email' => ''
        ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
        ]);

    }

    /** @test */
    function the_role_is_required()
    {

        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role' => ''
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function the_password_is_required()
    {

        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'password' => ''
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function it_loads_the_edit_user_page()
    {
        $user = factory(User::class)->create();

        $this->get(route('user.edit', $user))
            ->assertStatus(200)
            ->assertViewIs('user.edit')
            ->assertSee('EDITAR USUARIO')
            ->assertViewHas('user', $user);
    }

    /** @test */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();

        $this->put(route('user.update', $user), $this->getValidData())
            ->assertRedirect(route('user.details',$user));

        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'master'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {

        $user = factory(User::class)->create();

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData([
                'name' => ''
            ]))
        ->assertRedirect(route('user.edit', $user))
        ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['name' => 'erichbriceno@gmail.com']);
    }

    /** @test */
    function the_email_must_be_valid_when_updating_a_user()
    {

        $user = factory(User::class)->create();

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData([
                'email' => 'correo-no-valido'
            ]))
            ->assertRedirect(route('user.edit', $user))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['name' => 'Erich']);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user()
    {
        $this->withoutExceptionHandling();

        $oldPassword = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user),$this->getValidData([
                'password' => '',
            ]))
            ->assertRedirect(route('user.details', $user));
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

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user),$this->getValidData([
                'email' => 'existing-email@example.com'
            ]))
            ->assertRedirect(route('user.edit', $user))
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function the_users_email_can_stay_the_same_when_updating_a_user()
    {

        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com'
        ]);

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData())
            ->assertRedirect(route('user.details', $user));

        $this->assertEquals(1, User::count());
        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'master',
        ]);
    }

    /** @test */
    function it_deletes_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com'
        ]);

        $this->delete(route('user.destory', $user))
            ->assertRedirect(route('users'));

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com'
        ]);
    }

    protected function getValidData(array $custom = [])
    {

        return array_filter(array_merge([
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role' => 'master',
            'password' => 'secreto1',
        ], $custom));

    }
}
