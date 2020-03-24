<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_create_projects_page()
    {
        $this->get(route('project.create'))
            ->assertStatus(200)
            ->assertViewIs('project.create')
            ->assertSee(trans('titles.project.create'))
            ->assertSee('Nombre')
            ->assertSee('Descripción')
            ->assertSee('Fecha');
    }

    /** @test */
    function it_create_a_new_project()
    {
        $this->post(route('project.store'), $this->getProjectData())
            ->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

    /** @test */
    function the_name_is_required()
    {
        //$this->withoutExceptionHandling();
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => '',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

}