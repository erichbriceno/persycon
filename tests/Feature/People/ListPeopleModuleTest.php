<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{People};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListPeopleModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_people_list()
    {
        

        factory(People::class)->create(['names' => 'Pedro',]);
        factory(People::class)->create(['names' => 'Santiago']);

        $this->get(route('people'))
            ->assertStatus(200)
            ->assertSee('LISTADO DE GENTE' )
            ->assertSee('Pedro')
            ->assertSee('Santiago');
    }

    /** @test */
    function it_show_a_message_when_people_list_its_empty()
    {
        $this->get(route('people'))
            ->assertStatus(200)
            ->assertSee('No hay personas en la base de datos');
    }

    /** @test */
    function people_list_are_ordered_by_names()
    {
        // $this->withoutExceptionHandling();

        factory(People::class)->create(['names' => 'Monica Belussi']);
        factory(People::class)->create(['names' => 'Rita Rotino']);
        factory(People::class)->create(['names' => 'Marcela Roa']);

        $this->get(route('people', ['order' => 'names']))
            ->assertSeeInOrder([
                'Marcela Roa',
                'Monica Belussi',
                'Rita Rotino'
            ]);

        $this->get(route('people', ['order' => 'names-desc']))
            ->assertSeeInOrder([
                'Rita Rotino',
                'Monica Belussi',
                'Marcela Roa'
            ]);
    }

    /** @test */
    function people_list_are_ordered_by_id()
    {
        factory(People::class)->create(['names' => 'Monica Belussi']);
        factory(People::class)->create(['names' => 'Rita Rotino']);
        factory(People::class)->create(['names' => 'Marcela Roa']);

        $this->get(route('people', ['order' => 'id']))
            ->assertSeeInOrder([
                'Monica Belussi',
                'Rita Rotino',
                'Marcela Roa',
            ]);

        $this->get(route('people', ['order' => 'id-desc']))
            ->assertSeeInOrder([
                'Marcela Roa',
                'Rita Rotino',
                'Monica Belussi',              
            ]);

    }

    /** @test */
    function people_list_are_ordered_by_email()
    {
        factory(People::class)->create(['email' => 'ccorreo@test.com']);
        factory(People::class)->create(['email' => 'acorreo@test.com']);
        factory(People::class)->create(['email' => 'bcorreo@test.com']);

        $this->get(route('people', ['order' => 'email']))
            ->assertSeeInOrder([
                'acorreo@test.com',
                'bcorreo@test.com',
                'ccorreo@test.com',
            ]);

        $this->get(route('people', ['order' => 'email-desc']))
            ->assertSeeInOrder([
                'ccorreo@test.com',
                'bcorreo@test.com',
                'acorreo@test.com',
            ]);
    }

    /** @test */
    function users_list_are_ordered_by_cedulate()
    {
        factory(User::class)->create(['numberced' => '13']);
        factory(User::class)->create(['numberced' => '4']);
        factory(User::class)->create(['numberced' => '16']);

        $this->get(route('users', ['order' => 'cedule']))
            ->assertSeeInOrder([
                '4',
                '13',
                '16',
            ]);

        $this->get(route('users', ['order' => 'cedule-desc']))
            ->assertSeeInOrder([
                '16',
                '13',
                '4',
            ]);
    }

    // /** @test */
    // function invalid_order_query_data_is_ignored_and_the_default_order_is_used_instead()
    // {
    //     $this->withoutExceptionHandling();
    //     factory(User::class)->create(['names' => 'Monica Belussi', 'created_at' => now()->subDays(2)]);
    //     factory(User::class)->create(['names' => 'Marcela Roa', 'created_at' => now()->subDays(5)]);
    //     factory(User::class)->create(['names' => 'Rita Rotino', 'created_at' => now()->subDays(3)]);

    //     $this->get(route('users', ['order' => 'management']))
    //         ->assertOk()
    //         ->assertSeeInOrder([
    //             'Monica Belussi',
    //             'Marcela Roa',
    //             'Rita Rotino',
    //         ]);

    //     $this->get(route('users', ['order' => 'invalid_column-desc']))
    //         ->assertOk()
    //         ->assertSeeInOrder([
    //             'Monica Belussi',
    //             'Marcela Roa',
    //             'Rita Rotino',
    //         ]);
    // }

}
