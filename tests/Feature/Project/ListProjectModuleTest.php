<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{User, Project};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListProjectModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function when_an_administrator_goes_to_the_project_link_he_can_see_them()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->get(route('projects'))
            ->assertStatus(200)
            ->assertSee(trans('projects.emptyMessage.index'));
    }
    
    /** @test */
    function it_shows_the_projects_list()
    {
        $this->createRandomProject('Elecciones 2019');
        $this->createRandomProject('Mantenimiento 2020');
        
        $this->get(route('projects'))
            ->assertStatus(200)
            ->assertSee('LISTADO DE PROYECTOS' )
            ->assertSee('Elecciones 2019')
            ->assertSee('Mantenimiento 2020');
    }

    /** @test */
    function it_show_a_message_when_project_list_its_empty()
    {
        $this->get(route('projects'))
            ->assertStatus(200)
            ->assertSee('No hay proyectos creados');
    }

    /** @test */
    function projects_list_are_ordered_by_id()
    {
        factory(Project::class)->create(['name' => 'Elecciones 2019']);
        factory(Project::class)->create(['name' => 'Mantenimiento 2020']);
        factory(Project::class)->create(['name' => 'Municipales 2020']);

        $this->get(route('projects'))
            ->assertSeeInOrder([
                'Elecciones 2019',
                'Mantenimiento 2020',
                'Municipales 2020',
            ]);
    }
    
}
