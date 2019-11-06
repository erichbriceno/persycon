<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management, User};
use Illuminate\Foundation\Testing\RefreshDatabase;


class SearchUsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function search_users_by_name()
    {
        factory(User::class)->create([
            'names' => 'Pedro'
        ]);

        factory(User::class)->create([
            'names' => 'Santiago'
        ]);

        $this->get(route('users', ['search' => 'Pedro']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertDontSee('Santiago');
    }

    /** @test */
    function show_results_with_a_partial_search_by_name()
    {
        factory(User::class)->create([
            'names' => 'Pedro'
        ]);

        factory(User::class)->create([
            'names' => 'Santiago'
        ]);

        $this->get(route('users', ['search' => 'Pe']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertDontSee('Santiago');
    }

    /** @test */
    function search_users_by_full_name()
    {
        factory(User::class)->create([
            'names' => 'Pedro',
            'surnames' => 'Briceño'
        ]);

        factory(User::class)->create([
            'names' => 'Santiago',
            'surnames' => 'Briceño'
        ]);

        $this->get(route('users', ['search' => 'Pedro Briceño']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertDontSee('Santiago');
    }

    /** @test */
    function show_results_with_a_partial_search_by_full_name()
    {
        factory(User::class)->create([
            'names' => 'Pedro',
            'surnames' => 'Briceño'
        ]);

        factory(User::class)->create([
            'names' => 'Santiago',
            'surnames' => 'Briceño'
        ]);

        $this->get(route('users', ['search' => 'Pedro B']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertDontSee('Santiago');
    }

    /** @test */
    function search_users_by_email()
    {
        $pedro = factory(User::class)->create([
            'names' => 'Pedro',
            'email' => 'erichbriceno@gmail.com'
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago',
            'email' => 'elyotepongo@hotmail.com'
        ]);

        $this->get(route('users', ['search' => 'erichbriceno@gmail.com']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ($pedro, $santiago) {
               return $users->contains($pedro) && !$users->contains($santiago);
            });
    }

    /** @test */
    function show_results_with_a_partial_search_by_email()
    {
        $pedro = factory(User::class)->create([
            'names' => 'Pedro',
            'email' => 'erichbriceno@gmail.com'
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago',
            'email' => 'elyotepongo@hotmail.com'
        ]);

        $this->get(route('users', ['search' => '@gmail.com']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ($pedro, $santiago) {
                return $users->contains($pedro) && !$users->contains($santiago);
            });
    }

    /** @test */
    function search_users_by_management()
    {
        $pedro = factory(User::class)->create([
            'names' => 'Pedro',
            'management_id' => Management::Where('name', 'Mariche')->first()->id
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago',
            'management_id' => null
        ]);

        $jose = factory(User::class)->create([
            'names' => 'Jose',
            'management_id' => Management::Where('name', 'CNS')->first()->id
        ]);

        $this->get(route('users', ['management' => 'CNS']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago, $jose) {
                return $users->contains($jose)
                    && !$users->contains($pedro)
                    && !$users->contains($santiago);
            });
    }

    /** @test */
    function search_users_by_management_is_unassigned()
    {
        $pedro = factory(User::class)->create([
            'names' => 'Pedro',
            'management_id' => Management::Where('name', 'Mariche')->first()->id
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago',
            'management_id' => null
        ]);

        $jose = factory(User::class)->create([
            'names' => 'Jose',
            'management_id' => null
        ]);

        $this->get(route('users', ['management' => 'Unassigned']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago, $jose) {
                return $users->contains($jose)
                    && !$users->contains($pedro)
                    && $users->contains($santiago);
            });
    }

    /** @test */
    function search_users_by_all_management_and_unassigned_management()
    {
        //$this->withoutExceptionHandling();
        $pedro = factory(User::class)->create([
            'names' => 'Pedro',
            'management_id' => Management::Where('name', 'Mariche')->first()->id
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago',
            'management_id' => null
        ]);

        $jose = factory(User::class)->create([
            'names' => 'Jose',
            'management_id' => Management::Where('name', 'CNS')->first()->id
        ]);

        $this->get(route('users', ['management' => '']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago, $jose) {
                return $users->contains($jose)
                    && $users->contains($pedro)
                    && $users->contains($santiago);
            });
    }

}
