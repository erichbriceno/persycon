<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $role;

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
        $this->post(route('user.store'), $this->getValidData())
            ->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'first_name' => 'Erich',
            'last_name' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('description', 'User')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
        ]);
    }

    /** @test */
    function the_first_name_is_required()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'first_name' => ''
            ]))->assertRedirect(route('user.create'))
        ->assertSessionHasErrors(['first_name']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_last_name_is_required()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'last_name' => ''
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['last_name']);

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
            'first_name' => 'Erich',
        ]);
    }

    /** @test */
    function the_role_id_is_required()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => ''
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'first_name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_role_id_must_be_valid()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => '999'
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'first_name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function only_selectable_role_are_valid()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => Role::Where('description', 'Master')->first()->id
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'first_name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }


    /** @test */
    function the_management_id_is_optional()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'management_id' => ''
            ]))->assertRedirect(route('users'))
            ->assertSessionDoesntHaveErrors('managemnet_id');

        $this->assertDatabaseHas('users', [
            'first_name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_management_id_must_be_valid()
    {
        $this->from(route('user.create'))
            ->post(route('user.store'), $this->getValidData([
                'management_id' => '999'
            ]))->assertRedirect(route('user.create'))
            ->assertSessionHasErrors(['management_id']);

        $this->assertDatabaseMissing('users', [
            'first_name' => 'Erich',
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
            'first_name' => 'Erich',
            'email' => 'erichbriceno@gmail.com',
        ]);

    }

}
