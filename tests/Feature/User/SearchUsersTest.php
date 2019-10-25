<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{ User };
use Illuminate\Foundation\Testing\RefreshDatabase;


class SearchUsersTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    function search_users_by_name()
    {
        $this->loadRolesTable();
        factory(User::class)->create([
            'name' => 'Pedro'
        ]);

        factory(User::class)->create([
            'name' => 'Santiago'
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
        $this->loadRolesTable();
        factory(User::class)->create([
            'name' => 'Pedro'
        ]);

        factory(User::class)->create([
            'name' => 'Santiago'
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
        $this->loadRolesTable();
        $pedro = factory(User::class)->create([
            'name' => 'Pedro',
            'email' => 'erichbriceno@gmail.com'
        ]);

        $santiago = factory(User::class)->create([
            'name' => 'Santiago',
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
        $this->loadRolesTable();
        $pedro = factory(User::class)->create([
            'name' => 'Pedro',
            'email' => 'erichbriceno@gmail.com'
        ]);

        $santiago = factory(User::class)->create([
            'name' => 'Santiago',
            'email' => 'elyotepongo@hotmail.com'
        ]);

        $this->get(route('users', ['search' => '@gmail.com']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ($pedro, $santiago) {
                return $users->contains($pedro) && !$users->contains($santiago);
            });
    }

}
