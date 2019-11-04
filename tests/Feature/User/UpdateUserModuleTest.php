<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $role;

        /** @test */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();

        $this->put(route('user.update', $user), $this->getValidData([
            'role_id' => Role::Where('description', 'Administrator')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
        ]))
            ->assertRedirect(route('user.details',$user));

        $this->assertDatabaseHas('users', [
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('description', 'Administrator')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
        ]);
    }

    /** @test */
    function the_names_is_required_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData([
                'names' => ''
            ]))
        ->assertRedirect(route('user.edit', $user))
        ->assertSessionHasErrors(['names']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['names' => 'Erich Javier']);
    }

    /** @test */
    function the_surnames_is_required_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData([
                'surnames' => ''
            ]))
            ->assertRedirect(route('user.edit', $user))
            ->assertSessionHasErrors(['surnames']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['surnames' => 'Briceño']);
    }


    /** @test */
    function the_role_must_be_avalible_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from(route('user.edit', $user))
            ->put(route('user.update', $user), $this->getValidData([
                'role_id' => 1,
            ]))
            ->assertRedirect(route('user.edit', $user))
            ->assertSessionHasErrors(['role_id']);

        $this->assertEquals(1, User::count());
        $this->assertDatabaseMissing('users', ['names' => 'Erich Javier']);
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
        $this->assertDatabaseMissing('users', ['names' => 'Erich Javier']);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user()
    {
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
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

}
