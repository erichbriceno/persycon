<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\Project;
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

    /** @test */
    function the_name_of_only_containing_one_word()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => 'Elecciones Municipales',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Elecciones Municipales',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);	
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => 'Elecciones',
            ]))
            ->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'name' => 'Elecciones 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

    /** @test */
    function The_name_must_only_contain_alpha_characters()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => 'Elecciones_Municipales',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Elecciones_Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);	

        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => 'Elección',
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Elección 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);	
    }

    /** @test */
    function the_name_must_be_unique()
    {
        factory(Project::class)->create([
            'name' => 'Municipales 2020',
        ]);

        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => 'Municipales',
                'year' => '2020',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['name']);
            
        $this->assertSame(1, Project::where('name','Municipales 2020')->count());
    }

    /** @test */
    function the_name_must_be_made_up_of_the_name_and_the_year()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'name' => 'Caracola',
                'year' => 2019
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Caracola 2019',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

    
    /** @test */
    function the_year_is_required()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'year' => '',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['year']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

    /** @test */
    function the_year_must_be_valid()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'year' => 2018,
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['year']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'municipales 2018',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'year' => 2022,
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['year']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'municipales 2022',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'year' => 2019,
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2019',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
        
    }

    /** @test */
    function the_description_is_required()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'description' => '',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['description']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

    /** @test */
    function The_description_of_must_have_more_than_50_characters()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['description']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }

    /** @test */
    function the_start_date_is_required()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => '',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-20',
            'state' => '1'
            ]);
    }
    
    /** @test */
    function the_start_date_must_be_valid()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => 'date-no-valid',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => 'date-no-valid',
            'state' => '1'
            ]);
        
        
        $this->from(route('project.create'))
        ->post(route('project.store'), $this->getProjectData([
            'from' => '29/02/2019',
            ]))
        ->assertRedirect(route('project.create'))
        ->assertSessionHasErrors(['from']);

        $this->assertDatabaseMissing('projects', [
        'name' => 'Municipales 2020',
        'description' => 'Elecciones Municipales 2020',
        'start' => '2019-02-29',
        'state' => '1'
        ]);

        $this->from(route('project.create'))
        ->post(route('project.store'), $this->getProjectData([
            'from' => '29/02/2020',
            ]))
        ->assertRedirect(route('projects'));

        $this->assertDatabaseHas('projects', [
        'name' => 'Municipales 2020',
        'description' => 'Elecciones Municipales 2020',
        'start' => '2020-02-29',
        'state' => '1'
        ]);
    }

    /** @test */
    function the_start_date_cannot_be_less_than_one_year()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => today()->sub('1 year')->format('d/m/Y'),
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => today()->sub('1 year'),
            'state' => '1'
            ]);
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => today()->sub('1 year - 1 day')->format('d/m/Y'),
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => today()->sub('1 year - 1 day'),
            'state' => '1'
            ]);
    }

    /** @test */
    function the_start_date_cannot_be_more_than_one_year()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => today()->add('1 year 1 day')->format('d/m/Y'),
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['from']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => today()->add('1 year 1 day'),
            'state' => '1'
            ]);
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => today()->add('1 year')->format('d/m/Y'),
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => today()->add('1 year'),
            'state' => '1'
            ]);
    }

    /** @test */
    function the_ending_date_must_be_valid()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => today()->format('d/m/Y'),
                'to' => 'date-no-valid',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' =>  today(),
            'ending' => 'date-no-valid',
            'state' => '1'
            ]);
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => '22/02/2019',
                'to' => '29/02/2019',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['to']);
    
        $this->assertDatabaseMissing('projects', [
                'name' => 'Municipales 2020',
                'description' => 'Elecciones Municipales 2020',
                'start' => '2019-02-22',
                'ending' => '2019-02-29',
                'state' => '1'
            ]);

        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => '22/02/2020',
                'to' => '29/02/2020',
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-02-22',
            'ending' => '2020-02-29',
            'state' => '1'
            ]);
    }

    /** @test */
    function the_ending_date_can_be_null()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'to' => null,
                ]))
            ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'ending' => null,
            'state' => '1'
            ]);
    }

    /** @test */
    function the_ending_date_must_be_greater_than_the_start_date()
    {
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => '26/03/2020',
                'to' => '22/03/2020',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['to']);
        
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-26',
            'ending' => '2020-03-22',
            'state' => '1'
            ]);
        
        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => '26/03/2020',
                'to' => '26/03/2020',
                ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['to']);
        
        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-26',
            'ending' => '2020-03-26',
            'state' => '1'
            ]);

        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from' => '26/03/2020',
                'to' => '27/03/2020',
                ]))
            ->assertRedirect(route('projects'));
        
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => '2020-03-26',
            'ending' => '2020-03-27',
            'state' => '1'
            ]);
    }

    /** @test */
    function the_end_date_cannot_be_more_than_two_years_from_the_current_date()
    {
        //$this->withoutExceptionHandling();
        $this->from(route('project.create'))
        ->post(route('project.store'), $this->getProjectData([
            'from'  => today()->format('d-m-Y'),
            'to' => today()->add('2 years 1 day')->format('d-m-Y'),
            ]))
            ->assertRedirect(route('project.create'))
            ->assertSessionHasErrors(['to']);

        $this->assertDatabaseMissing('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start'  => today(),
            'ending' => today()->add('2 years 1 day'),
        ]);

        $this->from(route('project.create'))
            ->post(route('project.store'), $this->getProjectData([
                'from'  => today()->format('d/m/Y'),
                'to' => today()->add('2 years - 1 day')->format('d/m/Y'),
                ]))
                ->assertRedirect(route('projects'));
    
        $this->assertDatabaseHas('projects', [
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start'  => today(),
            'ending' => today()->add('2 years - 1 day'),
            ]);
        
    }
}