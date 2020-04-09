<?php

namespace Tests\Feature\Project;

use Tests\TestCase;
use App\Model\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteProjectTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function it_sends_a_project_to_the_trash()
    {
        //$this->withoutExceptionHandling();
        
        $project = factory(Project::class)->create([
            'name' => 'Municipales 2020'
        ]);

        $this->patch(route('project.trash', $project))
            ->assertRedirect(route('projects'));

        $this->assertSoftDeleted('projects', [
                'id' => $project->id,
            ]);

        $this->assertSame(0, Project::all()->count());
            
        $project->refresh();
        $this->assertTrue($project->trashed());
    }

    /** @test */
    function it_shows_the_trashed_projects_list()
    {
        factory(Project::class)->create([
            'name' => 'Elecciones 2019',
            'description' => 'Elecciones Regionales 2019',
        ]);

        $project = factory(Project::class)->create([
            'name' => 'Mantenimiento 2020',
            'description' => 'Mantenimiento de la Plataforma 2020',
        ]);


        $this->patch(route('project.trash', $project))
            ->assertRedirect(route('projects'));
        
        
        $this->get(route('projects.trash'))
            ->assertStatus(200)
            ->assertSee(trans('titles.project.trash'))
            ->assertSee('Mantenimiento 2020');
    }

    /** @test */
    function it_restores_a_project_from_the_trash()
    {
        $project = factory(Project::class)->create([
            'name' => 'Elecciones 2019',
            'description' => 'Elecciones Regionales 2019',
            'deleted_at' => now()
        ]);

        $this->patch(route('project.restore', $project))
            ->assertRedirect(route('projects.trash'))
            ->assertDontSee('Elecciones 2019');

        $this->assertDatabaseHas('projects', [
            'name' => 'Elecciones 2019',
            'deleted_at' => null,
        ]);

        $this->get(route('projects'))
            ->assertSee('Elecciones 2019');
    }

    /** @test */
    function it_completely_deletes_a_project()
    {
        $project = factory(Project::class)->create([
            'name' => 'Elecciones 2019',
            'deleted_at' => now(),
        ]);

        $this->delete(route('project.destory', $project))
            ->assertRedirect(route('projects.trash'));

        $this->assertDatabaseMissing('projects', [
            'name' => 'Elecciones 2019',
        ]);
    }

}
