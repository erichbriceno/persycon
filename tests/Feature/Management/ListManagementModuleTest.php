<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Management};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListManagementModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_managements_list()
    {
        //*
        factory(Management::class)->create([
            'name' => 'Guatire',
            'description' => 'Master Administrator',
        ]);

        factory(Management::class)->create([
            'name' => 'Margarita',
            'description' => 'Galpon CNE Mariche',
        ]);
        //*/
        $this->get(route('managements'))
            ->assertStatus(200)
            ->assertSee('LISTADO DE GERENCIAS')
            ->assertSee('Guatire')
            ->assertSee('Margarita');
    }

    /** @test */
    function it_show_a_message_when_management_list_its_empty()
    {
        $this->markTestSkipped();
        $this->get(route('managements'))
            ->assertStatus(200)
            ->assertSee('No hay gerencias creadas');
    }

    /** @test */
    function management_list_are_ordered_by_id()
    {
        $this->markTestSkipped();
        factory(Management::class)->create(['name' => 'Guatire']);
        factory(Management::class)->create(['name' => 'Margarita']);
        factory(Management::class)->create(['name' => 'Cucuta']);

        $this->get(route('managements'))
            ->assertSeeInOrder([
                'Guatire',
                'Margatira',
                'Cucuta',
            ]);
    }
    
}
