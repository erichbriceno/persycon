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
            'first_name' => 'Pedro'
        ]);

        factory(User::class)->create([
            'first_name' => 'Santiago'
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
            'first_name' => 'Pedro'
        ]);

        factory(User::class)->create([
            'first_name' => 'Santiago'
        ]);

        $this->get(route('users', ['search' => 'Pe']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertDontSee('Santiago');
    }

    /** @test */
    function search_users_by_email()
    {
        $pedro = factory(User::class)->create([
            'first_name' => 'Pedro',
            'email' => 'erichbriceno@gmail.com'
        ]);

        $santiago = factory(User::class)->create([
            'first_name' => 'Santiago',
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
            'first_name' => 'Pedro',
            'email' => 'erichbriceno@gmail.com'
        ]);

        $santiago = factory(User::class)->create([
            'first_name' => 'Santiago',
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
            'first_name' => 'Pedro',
            'management_id' => Management::Where('name', 'Mariche')->first()->id
        ]);

        $santiago = factory(User::class)->create([
            'first_name' => 'Santiago',
            'management_id' => null
        ]);

        $jose = factory(User::class)->create([
            'first_name' => 'Jose',
            'management_id' => Management::Where('name', 'CNS')->first()->id
        ]);

        $this->get(route('users', ['search' => 'CNS']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago, $jose) {
                return $users->contains($jose)
                    && !$users->contains($pedro)
                    && !$users->contains($santiago);
            });
    }

    /** @test */
    function partial_search_by_management_name()
    {
        $pedro = factory(User::class)->create([
            'first_name' => 'Pedro',
            'management_id' => Management::Where('name', 'Mariche')->first()->id
        ]);

        $santiago = factory(User::class)->create([
            'first_name' => 'Santiago',
            'management_id' => null
        ]);

        $jose = factory(User::class)->create([
            'first_name' => 'Jose',
            'management_id' => Management::Where('name', 'CNS')->first()->id
        ]);

        $this->get(route('users', ['search' => 'CN']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago, $jose) {
                return $users->contains($jose)
                    && !$users->contains($pedro)
                    && !$users->contains($santiago);
            });
    }

}
