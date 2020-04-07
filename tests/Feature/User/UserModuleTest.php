<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $role;

     /** @test */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('name', 'User')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
            'password' => 'secreto1',
        ]);

        $this->get(route('user.details', $user))
            ->assertStatus(200)
            ->assertSee('Erich Javier')
            ->assertSee('Briceño')
            ->assertSee('User');

    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/users/1')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
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
    function it_sends_a_user_to_the_trash()
    {
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
        factory(User::class)->create([
            'names' => 'Pedro',
            'deleted_at' => now(),
        ]);

        factory(User::class)->create([
            'names' => 'Santiago'
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
        $user = factory(User::class)->create([
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => now()
        ]);

        $this->patch(route('user.restore', $user))
            ->assertRedirect(route('users.trash'));

        $this->assertDatabaseHas('users', [
            'email' => 'erichbriceno@gmail.com',
            'deleted_at' => null,
        ]);
    }

}
