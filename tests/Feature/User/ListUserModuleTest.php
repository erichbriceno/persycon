<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListUserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_users_list()
    {
        factory(User::class)->create([
            'names' => 'Pedro',
        ]);

        factory(User::class)->create([
            'names' => 'Santiago'
        ]);

        $this->get(route('users'))
            ->assertStatus(200)
            ->assertSee('LISTADO DE USUARIOS' )
            ->assertSee('Pedro')
            ->assertSee('Santiago');
    }

    /** @test */
    function it_show_a_message_when_user_list_its_empty()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function users_list_are_ordered_by_names()
    {
        factory(User::class)->create(['names' => 'Monica Belussi']);
        factory(User::class)->create(['names' => 'Rita Rotino']);
        factory(User::class)->create(['names' => 'Marcela Roa']);

        $this->get(route('users', ['order' => 'names']))
            ->assertSeeInOrder([
                'Marcela Roa',
                'Monica Belussi',
                'Rita Rotino'
            ]);

        $this->get(route('users', ['order' => 'names', 'direction' => 'desc']))
            ->assertSeeInOrder([
                'Rita Rotino',
                'Monica Belussi',
                'Marcela Roa'
            ]);
    }

    /** @test */
    function users_list_are_ordered_by_id()
    {
        factory(User::class)->create(['names' => 'Monica Belussi']);
        factory(User::class)->create(['names' => 'Rita Rotino']);
        factory(User::class)->create(['names' => 'Marcela Roa']);

        $this->get(route('users', ['order' => 'id']))
            ->assertSeeInOrder([
                'Monica Belussi',
                'Rita Rotino',
                'Marcela Roa',
            ]);

        $this->get(route('users', ['order' => 'id', 'direction' => 'desc']))
            ->assertSeeInOrder([
                'Marcela Roa',
                'Rita Rotino',
                'Monica Belussi',
            ]);
    }

    /** @test */
    function users_list_are_ordered_by_email()
    {
        factory(User::class)->create(['email' => 'ccorreo@test.com']);
        factory(User::class)->create(['email' => 'acorreo@test.com']);
        factory(User::class)->create(['email' => 'bcorreo@test.com']);

        $this->get(route('users', ['order' => 'email']))
            ->assertSeeInOrder([
                'acorreo@test.com',
                'bcorreo@test.com',
                'ccorreo@test.com',
            ]);

        $this->get(route('users', ['order' => 'email', 'direction' => 'desc']))
            ->assertSeeInOrder([
                'ccorreo@test.com',
                'bcorreo@test.com',
                'acorreo@test.com',
            ]);
    }

    /** @test */
    function users_list_are_ordered_by_registration_date()
    {
        factory(User::class)->create(['names' => 'Monica Belussi', 'created_at' => now()->subDays(2)]);
        factory(User::class)->create(['names' => 'Marcela Roa', 'created_at' => now()->subDays(5)]);
        factory(User::class)->create(['names' => 'Rita Rotino', 'created_at' => now()->subDays(3)]);

        $this->get(route('users', ['order' => 'created_at']))
            ->assertSeeInOrder([
                'Marcela Roa',
                'Rita Rotino',
                'Monica Belussi',
            ]);

        $this->get(route('users', ['order' => 'created_at', 'direction' => 'desc']))
            ->assertSeeInOrder([
                'Monica Belussi',
                'Rita Rotino',
                'Marcela Roa',
            ]);
    }

}
