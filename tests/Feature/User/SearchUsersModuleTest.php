<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management, Role, User};
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
        $pedro = factory(User::class)->create([
            'names' => 'Pedro'
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago'
        ]);

        $this->get(route('users', ['search' => 'Pe']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ($pedro, $santiago) {
                return $users->contains($pedro) && !$users->contains($santiago);
            });
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
        $pedro = factory(User::class)->create([
            'names' => 'Pedro',
            'surnames' => 'Briceño'
        ]);

        $santiago = factory(User::class)->create([
            'names' => 'Santiago',
            'surnames' => 'Briceño'
        ]);

        $this->get(route('users', ['search' => 'Pedro B']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ($pedro, $santiago) {
                return $users->contains($pedro) && !$users->contains($santiago);
            });

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

    /** @test */
    function search_users_by_state_active()
    {
        $this->withoutExceptionHandling();
        $pedro = factory(User::class)->create([
            'active' => true,
        ]);

        $santiago = factory(User::class)->create([
            'active' => false,
        ]);

        $this->get(route('users', ['state' => 'active']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago) {
                return $users->contains($pedro)
                    && !$users->contains($santiago);
            });
    }

    /** @test */
    function search_users_by_state_inactive()
    {
        $this->withoutExceptionHandling();
        $pedro = factory(User::class)->create([
            'active' => true,
        ]);

        $santiago = factory(User::class)->create([
            'active' => false,
        ]);

        $this->get(route('users', ['state' => 'inactive']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago) {
                return !$users->contains($pedro)
                    && $users->contains($santiago);
            });
    }

    /** @test */
    function search_users_by_state_all()
    {
        $this->withoutExceptionHandling();
        $pedro = factory(User::class)->create([
            'active' => true,
        ]);

        $santiago = factory(User::class)->create([
            'active' => false,
        ]);

        $this->get(route('users', ['state' => 'all']))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago) {
                return $users->contains($pedro)
                    && $users->contains($santiago);
            });
    }

    /** @test */
    function search_users_by_roles()
    {
        $this->withoutExceptionHandling();

        $pedro = factory(User::class)->create([
            'role_id' => Role::Where('name', 'User')->first()->id,
        ]);

        $santiago = factory(User::class)->create([
            'role_id' => Role::Where('name', 'Master')->first()->id,
        ]);

        $jose = factory(User::class)->create([
            'role_id' => Role::Where('name', 'Administrator')->first()->id,
        ]);

        $this->get(route('users',
            ['roles' => [
                'User',
                'Master'
                ]
            ]))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertViewHas('users', function ($users) use ( $pedro, $santiago, $jose) {
                return $users->contains($pedro)
                    && $users->contains($santiago)
                    && !$users->contains($jose);
            });
    }

    /** @test */
    function filter_users_created_from_date()
    {
        $newestUser = factory(User::class)->create([
            'created_at' => '2018-10-02 12:00:00',
        ]);
        $oldestUser = factory(User::class)->create([
            'created_at' => '2018-09-29 12:00:00',
        ]);
        $newUser = factory(User::class)->create([
            'created_at' => '2018-10-01 00:00:00',
        ]);
        $oldUser = factory(User::class)->create([
            'created_at' => '2018-09-30 23:59:59',
        ]);

        $response = $this->get(route('users', ['from' => '01/10/2018']));

        $response->assertOk();

        $response->assertViewHas('users', function ($users)
            use ( $newUser, $newestUser, $oldUser, $oldestUser) {
                return
                    $users->contains($newUser)
                    && $users->contains($newestUser)
                    && !$users->contains($oldUser)
                    && !$users->contains($oldestUser);
            });

    }
    /** @test */
    function filter_users_created_to_date()
    {
        $newestUser = factory(User::class)->create([
            'created_at' => '2018-10-02 12:00:00',
        ]);
        $oldestUser = factory(User::class)->create([
            'created_at' => '2018-09-29 12:00:00',
        ]);
        $newUser = factory(User::class)->create([
            'created_at' => '2018-10-01 00:00:00',
        ]);
        $oldUser = factory(User::class)->create([
            'created_at' => '2018-09-30 23:59:59',
        ]);

        $response = $this->get(route('users', ['to' => '30/09/2018']));

        $response->assertOk();

        $response->assertViewHas('users', function ($users)
            use ( $newUser, $newestUser, $oldUser, $oldestUser) {
                return
                    $users->contains($oldestUser)
                    && $users->contains($oldUser)
                    && !$users->contains($newestUser)
                    && !$users->contains($newUser);
            });
    }

}
