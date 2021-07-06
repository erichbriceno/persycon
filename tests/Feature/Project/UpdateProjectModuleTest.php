<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProjectModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_update_a_project_allowed_fields()
    {
        $project = factory(Project::class)->create();
        
        $this->put(route('project.update', $project),
            [
                'description'   => 'Breve descripción',
                'from'          => '08/04/2020',
                'to'            => '10/04/2020',
                'state'         => 'active'
            ])->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',
            'start'         => '2020-04-08',
            'ending'        => '2020-04-10'
            ]);
    }

    /** @test */
    function the_name_and_year_of_a_project_cannot_be_updated()
    {
        $project = factory(Project::class)->create([
            'name'  => 'Consejales 2020'
        ]);
        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'name'          => 'Maestros',
                'year'          => '2010',
                'description'   => 'Breve descripción',
                'from'          => '08/04/2020',
                'to'            => '10/04/2020',
                'state'         => 'active'
            ])->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'name'          =>  'Consejales 2020',
            'description'   => 'Breve descripción',
            'start'         => '2020-04-08',
            'ending'        => '2020-04-10'
            ]);
    }

    /** @test */
    function the_description_cant_be_null_when_updating_a_project()
    {
        $project = factory(Project::class)->create();
        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => '',
                'from'          => '08/04/2020',
                'to'            => '10/04/2020',
            ])->assertRedirect(route('project.edit', $project))
            ->assertSessionHasErrors(['description']);
        
        $this->assertDatabaseMissing('projects', [
            'description'   => '',
            'start'         => '2020-04-08',
            'ending'        => '2020-04-10'
            ]);
        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => null,
                'from'          => '08/04/2020',
                'to'            => '10/04/2020',
                'state'         => 'active'
            ])->assertRedirect(route('project.edit', $project))
            ->assertSessionHasErrors(['description']);
        
        $this->assertDatabaseMissing('projects', [
            'description'   => null,
            'start'         => '2020-04-08',
            'ending'        => '2020-04-10'
            ]);
    }

    /** @test */
    function The_description_of_must_have_more_than_50_characters_when_updating_a_project()
    {
        $project = factory(Project::class)->create();
        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
                'from'          => '08/04/2020',
                'to'            => '10/04/2020',
                'state'         => 'active',
            ])->assertRedirect(route('project.edit', $project))
            ->assertSessionHasErrors(['description']);
        
        $this->assertDatabaseMissing('projects', [
            'description'   => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
            'start'         => '2020-04-08',
            'ending'        => '2020-04-10'
            ]);

        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => '12345678901234567890123456789012345678901234567890',
                'from'          => '08/04/2020',
                'to'            => '10/04/2020',
                'state'         => 'active',
            ])->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'description'   => '12345678901234567890123456789012345678901234567890',
            'start'         => '2020-04-08',
            'ending'        => '2020-04-10'
            ]);
        
    }

    /** @test */
    function the_start_date_is_required_when_updating_a_project()
    {
        $project = factory(Project::class)->create();
        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [

                'from'  => '',
                'state'         => 'active',
            ])->assertRedirect(route('project.edit', $project))
            ->assertSessionHasErrors(['from']);
        
        $this->assertDatabaseMissing('projects', [
            'start'     => '',
            ]);
        

        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'from'  => null,
                'state'         => 'active',
            ])->assertRedirect(route('project.edit', $project))
            ->assertSessionHasErrors(['from']);
        
        $this->assertDatabaseMissing('projects', [
            'start'     => null,
            ]);
        
    }
    
    /** @test */
    function the_start_date_must_be_valid_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',
            'from'  => 'date-no-valid',
            'state'         => 'active',
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'start'     => 'date-no-valid',
            ]);

        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => 'Breve descripción',        
                'from'  => '29/02/2019',
                'state'         => 'active',
            ])->assertRedirect(route('project.edit', $project))
            ->assertSessionHasErrors(['from']);
        
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'     => '2019-02-29',
            ]);


        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => 'Breve descripción',
                'from'  => '29/05/2021',
                'state'         => 'active',
            ])->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',
            'start'     => '2021-05-29',
            ]);
    }

    /** @test */
    function the_start_date_cannot_be_less_than_one_year_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',        
            'from' => today()->sub('1 year')->format('d/m/Y'),
            'state'         => 'active',
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'         => today()->sub('1 year'),
            ]);

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',        
            'from' => today()->sub('1 year - 1 day')->format('d/m/Y'),
            'state'         => 'active',
        ])->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',          
            'start'         => today()->sub('1 year - 1 day'),
            ]);
    }

    /** @test */
    function the_start_date_cannot_be_more_than_one_year_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',        
            'from' => today()->add('1 year 1 day')->format('d/m/Y'),
            'state'         => 'active',
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'         => today()->add('1 year 1 day'),
            ]);

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',        
            'from' => today()->add('1 year')->format('d/m/Y'),
            'state'         => 'active',
        ])->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',          
            'start'         => today()->add('1 year'),
            ]);
    }

    /** @test */
    function the_ending_date_must_be_valid_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',
            'from'  => today()->format('d/m/Y'),
            'to'    => 'date-no-valid',     
            'state'         => 'active',  
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'     =>  today(),
            'ending'    => 'date-no-valid',
            ]);

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',
            'from'  => '22/02/2019',
            'to'    => '29/02/2019',
            'state'         => 'active',       
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start' => '2019-02-22',
            'ending' => '2019-02-29',
            ]);

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción', 
            'from'          => '22/10/2020',
            'to'            => '29/10/2020', 
            'state'         => 'active',      
        ])->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',          
            'start' => '2020-10-22',
            'ending' => '2020-10-29',
            ]);
    }

    /** @test */
    function the_ending_date_can_be_null_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción', 
            'from'          => '22/10/2020',
            'to'            => null,
            'state'         => 'active',       
        ])->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',          
            'start'         => '2020-10-22',
            'ending'        => null,
            ]);
    }

    /** @test */
    function the_ending_date_must_be_greater_than_the_start_date_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',
            'from'          => '26/03/2020',
            'to'            => '22/03/2020', 
            'state'         => 'active',    
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'         => '2020-03-26',
            'ending'        => '2020-03-22',
            ]);

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',
            'from'          => '26/03/2020',
            'to'            => '26/03/2020', 
            'state'         => 'active',    
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'         => '2020-03-26',
            'ending'        => '2020-03-26',
            ]);

        
        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción', 
            'from'          => '26/03/2020',
            'to'            => '27/03/2020', 
            'state'         => 'active',     
        ])->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',          
            'start'         => '2020-03-26',
            'ending'        => '2020-03-27',
            ]);
    }

    /** @test */
    function the_end_date_cannot_be_more_than_two_years_from_the_current_date_when_updating_a_project()
    {
        $project = factory(Project::class)->create();

        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción',
            'from'          => today()->format('d/m/Y'),
            'to'            => today()->add('2 years 1 day')->format('d/m/Y'), 
            'state'         => 'active',   
        ])->assertRedirect(route('project.edit', $project))
        ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
            'description'   => 'Breve descripción',          
            'start'         => today(),
            'ending'        => today()->add('2 years 1 day'),
            ]);
        
        $this->from(route('project.edit', $project))
        ->put(route('project.update', $project),
        [
            'description'   => 'Breve descripción', 
            'from'          => today()->format('d/m/Y'),
            'to'            => today()->add('2 years - 1 day')->format('d/m/Y'),
            'state'         => 'active',    
        ])->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'description'   => 'Breve descripción',          
            'start'         => today(),
            'ending'        => today()->add('2 years - 1 day'),
            ]);
    }

    /** @test */
    function the_project_updates_to_active_if_it_is_inactive()
    {
        //$this->withoutExceptionHandling();
        
        $project = factory(Project::class)->create([
            'name'  => 'Consejales 2020',
            'active' => true
        ]);
        
        $this->from(route('project.edit', $project))
            ->put(route('project.update', $project),
            [
                'description'   => 'Breve descripción',
                'from'          => today()->format('d/m/Y'),
                'state'         => 'inactive'
            ])->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'name'  => 'Consejales 2020',
            'active' => false
            ]);
    }

}