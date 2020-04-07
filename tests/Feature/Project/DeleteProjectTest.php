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

}
