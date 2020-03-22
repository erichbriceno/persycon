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
        $this->post(route('project.store'), [
                'name' => 'Municipales 2020',
                'description' => 'Elecciones Municipales 2020',
                'from' =>  '2020-03-22',
                'active' => true,
            ])
            ->assertRedirect(route('projects'));   
    }
}
