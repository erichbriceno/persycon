<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Cedulate, Management, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $role;

    /** @test */
    function it_loads_the_new_users_page()
    {
        $role = factory(Role::class)->create();

        $this->get(route('user.create',['cedule' => '13683474']))
            ->assertStatus(200)
            ->assertViewIs('user.create')
            ->assertSee(trans('titles.title.create'))
            ->assertViewHas('roles', function ($roles) use ($role) {
                return $roles->contains($role);
            });
    }

    /** @test */
    function it_loads_the_new_users_page_with_error_when_dont_have_cedule_number()
    {
        $this->get(route('user.create'))
            ->assertViewIs('user.create');

    }

    /** @test */
    function it_create_a_new_user()
    {
        $this->post(route('user.store'), $this->getValidData())
            ->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'nat' => 'V',
            'numberced' => '13683474',
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('name', 'User')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
            'active' => true
        ]);
    }


    /** @test */
    function the_nat_is_required()
    {
        self::markTestIncomplete();
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'nat' => ''
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['nat']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_nat_must_be_valid()
    {
        self::markTestIncomplete();
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'nat' => 'A'
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['nat']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }



    /** @test */
    function the_numberced_is_required()
    {
        self::markTestIncomplete();
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'numberced' => ''
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['numberced']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_numberced_must_be_greater_than_300k()
    {
        self::markTestIncomplete();
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'numberced' => '299999'
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['numberced']);

        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'numberced' => '300000'
            ]))->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_number_must_be_less_than_100Mill()
    {
        self::markTestIncomplete();
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'numberced' => '100000001'
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['numberced']);

        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'numberced' => '100000000'
            ]))->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }


    /** @test */
    function the_names_is_required()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'names' => ''
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
        ->assertSessionHasErrors(['names']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_surnames_is_required()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'surnames' => ''
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['surnames']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_email_is_required()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
            'email' => ''
        ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
        ]);
    }

    /** @test */
    function the_role_id_is_required()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => ''
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_role_id_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => '999'
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function only_selectable_role_are_valid()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'role_id' => Role::Where('name', 'Master')->first()->id
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['role_id']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }


    /** @test */
    function the_management_id_is_optional()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'management_id' => ''
            ]))->assertRedirect(route('users'))
            ->assertSessionDoesntHaveErrors('managemnet_id');

        $this->assertDatabaseHas('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_management_id_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'management_id' => '999'
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['management_id']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_management_id_can_not_be_Unassigned()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'management_id' => Management::where('name', 'Unassigned')->first()->id
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['management_id']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'password' => ''
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_password_must_be_verified()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'password' => 'clave1',
                'password_confirmation' => 'clave1',
            ]))->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_password_and_password_confirm_are_be_same()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'password' => 'clave1',
                'password_confirmation' => 'clave2',
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_state_id_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'state' => 'no-valid-state'
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['state']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_state_is_required()
    {
        $this->from(route('user.create',['cedule' => '13683474']))
            ->post(route('user.store'), $this->getValidData([
                'state' => null
            ]))->assertRedirect(route('user.create',['cedule' => '13683474']))
            ->assertSessionHasErrors(['state']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }



}
