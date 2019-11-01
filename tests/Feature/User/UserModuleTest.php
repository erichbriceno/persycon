<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{ Role, User };
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $role;

    /** @test */
    function it_shows_the_users_list()
    {
        factory(Role::class)->create(['description' => 'User']);
        factory(User::class)->create([
            'name' => 'Pedro',
        ]);

        factory(User::class)->create([
            'name' => 'Santiago'
        ]);

        $this->get(route('users'))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertSee('Santiago');
    }

    /** @test */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create($this->getValidData([
            'role_id' => factory(Role::class)->create(['description' => 'User'])->id
        ]));

        $this->get(route('user.details', $user))
            ->assertStatus(200)
            ->assertSee('Erich')
            ->assertSee('User');

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
    function it_loads_the_new_users_page()
    {
        $role = factory(Role::class)->create();

        $this->get(route('user.create'))
            ->assertViewIs('user.create')
            ->assertStatus(200)
            ->assertSee('REGISTRAR USUARIO')
            ->assertViewHas('roles', function ($roles) use ($role) {
                return $roles->contains($role);
            });
    }

    /** @test */
    function it_create_a_new_user()
    {
        $this->loadRolesTable();
        $this->post(route('user.store'), $this->getValidData())
            ->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('description', 'User')->first()->id,
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
        $this->loadRolesTable();
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
        $this->loadRolesTable();
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
    function the_role_id_is_required()
    {
        $this->loadRolesTable();
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => ''
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

    /** @test */
    function the_role_id_must_be_valid()
    {
        $this->loadRolesTable();
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => '999'
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function only_selectable_role_are_valid()
    {
        $this->loadRolesTable();

        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => Role::Where('description', 'Master')->first()->id
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }


    /** @test */
    function the_password_is_required()
    {
        $this->loadRolesTable();
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
        $this->loadRolesTable();
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
        $this->loadRolesTable();
        $user = factory(User::class)->create();

        $this->put(route('user.update', $user), $this->getValidData([
            'role_id' => Role::Where('description', 'Administrator')->first()->id
        ]))
            ->assertRedirect(route('user.details',$user));

        $this->assertDatabaseHas('users', [
            'name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('description', 'Administrator')->first()->id
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {
        $this->loadRolesTable();
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
    function the_role_must_be_avalible_when_updating_a_user()
    {
//        $this->withoutExceptionHandling();
        $this->loadRolesTable();
        $user = factory(User::class)->create();

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData([
                'role_id' => 1,
            ]))
            ->assertRedirect(route('user.edit', $user))
            ->assertSessionHasErrors(['role_id']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['name' => 'Erich']);
    }

    /** @test */
    function the_email_must_be_valid_when_updating_a_user()
    {
        $this->loadRolesTable();
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
        $this->loadRolesTable();
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
        $this->loadRolesTable();
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
        $this->loadRolesTable();
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
        ]);
    }

    /** @test */
    function it_sends_a_user_to_the_trash()
    {
        $this->loadRolesTable();
        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com'
        ]);

        $this->patch(route('user.trash', $user))
            ->assertRedirect(route('users'));

        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);

        $user->refresh();
        $this->assertTrue($user->trashed());
    }

    /** @test */
    function it_shows_the_deleted_users()
    {
        $this->withoutExceptionHandling();
        $this->loadRolesTable();
        factory(User::class)->create([
            'name' => 'Pedro',
            'deleted_at' => now(),
        ]);

        factory(User::class)->create([
            'name' => 'Santiago'
        ]);

        $this->get(route('users.trash'))
            ->assertStatus(200)
            ->assertSee('PAPELERA DE USUARIOS')
            ->assertSee('Pedro')
            ->assertDontSee('Santiago');

    }

    /** @test */
    function it_completely_deletes_a_user()
    {
        $this->loadRolesTable();
        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => now(),
        ]);

        $this->delete(route('user.destory', $user))
            ->assertRedirect(route('users.trash'));

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com'
        ]);
    }

    /** @test */
    function it_cannot_delete_a_user_that_is_not_in_the_trash()
    {
        $this->loadRolesTable();
        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => null,
        ]);

        $this->delete(route('user.destory', $user))
            ->assertStatus(404);

        $this->assertDatabaseHas('users', [
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => null,
        ]);
    }

    /** @test */
    function it_restores_a_user_from_the_trash()
    {
        $this->withoutExceptionHandling();
        $this->loadRolesTable();
        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => now()
        ]);

        $this->patch(route('user.restore', $user))
            ->assertRedirect(route('users.trash'));
//            ->assertStatus(200)
//            ->assertSee('erichbriceno@gmail.com');

        $this->assertDatabaseHas('users', [
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => null,
        ]);
    }

//    /** @test */
//    function it_cannot_restores_a_user_from_the_trash_if_delete_at_are_null()
//    {
//        $this->withoutExceptionHandling();
//        $this->loadRolesTable();
//        $user = factory(User::class)->create([
//            'email' => 'erichbriceno@gmail.com',
//            'deleted_at' => null
//        ]);
//
//        $this->patch(route('user.restore', $user))
//            ->assertRedirect(route('users.trash'));
////            ->assertStatus(200)
////            ->assertSee('erichbriceno@gmail.com');
//
//        $this->assertDatabaseHas('users', [
//            'email' => 'erichbriceno@gmail.com',
//            'deleted_at' => null,
//        ]);
//    }

}
