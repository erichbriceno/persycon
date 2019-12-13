<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Cedulate, Management, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_new_users_page()
    {
        $role = factory(Role::class)->create();

        $this->get(route('user.create',['cedule' => Cedulate::first()->cedule ]))
            ->assertStatus(200)
            ->assertViewIs('user.create')
            ->assertSee(trans('titles.title.create'))
            ->assertViewHas('roles', function ($roles) use ($role) {
                return $roles->contains($role);
            });
    }

    /** @test */
    function it_redirect_to_finder_page_when_dont_have_cedule()
    {
        $this->get(route('user.create'))
            ->assertRedirect(route('user.find'));
    }

    /** @test */
    function it_redirect_to_finder_page_when_cedule_is_invalid()
    {
        $this->get(route('user.create', ['cedule' => 'invalid-cedule']))
            ->assertRedirect(route('user.find'));
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
    function the_cedule_is_required()
    {

        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'cedule' => ''
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['cedule']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_cedule_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'cedule' => 'F13683474A'
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['cedule']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_cedule_must_be_unique()
    {

        $role = factory(Role::class)->create();

        factory(User::class)->create([
            'management_id' => null,
            'nat' => 'V',
            'numberced' => '13683474',
            'names' => 'Erich Javier',
            'surnames' => 'Briceno',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => $role->id,
            'password' => bcrypt('secreto1'),
        ]);

        $this->from(route('user.create',['cedule' => 'V13683474']))
            ->post(route('user.store'), $this->getValidData([
                'cedule' => 'V13683474'
            ]))->assertRedirect(route('user.create',['cedule' => 'V13683474']))
            ->assertSessionHasErrors(['cedule']);

        $this->assertSame(1, User::where('numberced','13683474')->count());
    }

    /** @test */
    function the_names_is_required()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'names' => ''
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
        ->assertSessionHasErrors(['names']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_surnames_is_required()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'surnames' => ''
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['surnames']);

        $this->assertDatabaseMissing('users', [
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_email_is_required()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
            'email' => ''
        ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
        ]);
    }

    /** @test */
    function the_role_id_is_required()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'role' => ''
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['role']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_role_id_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'role' => '999'
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['role']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function only_selectable_role_are_valid()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'role' => Role::Where('name', 'Master')->first()->id
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['role']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }


    /** @test */
    function the_management_id_is_optional()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'management' => ''
            ]))->assertRedirect(route('users'))
            ->assertSessionDoesntHaveErrors('managemnet');

        $this->assertDatabaseHas('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_management_id_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'management' => '999'
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['management']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_management_id_can_not_be_Unassigned()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'management' => Management::where('name', 'Unassigned')->first()->id
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['management']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'password' => ''
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_password_must_be_verified()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
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
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'password' => 'clave1',
                'password_confirmation' => 'clave2',
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_state_id_must_be_valid()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'state' => 'no-valid-state'
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['state']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }

    /** @test */
    function the_state_is_required()
    {
        $this->from(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->post(route('user.store'), $this->getValidData([
                'state' => null
            ]))->assertRedirect(route('user.create',['cedule' => Cedulate::first()->cedule]))
            ->assertSessionHasErrors(['state']);

        $this->assertDatabaseMissing('users', [
            'names' => 'Erich Javier',
            'email' => 'erichbriceno@gmail.com',
        ]);
    }



}
