<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\Management;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateManagementModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_create_managements_page()
    {
        $this->get(route('management.create'))
            ->assertStatus(200)
            ->assertViewIs('management.create')
            ->assertSee(trans('titles.management.create'))
            ->assertSee('Siglas')
            ->assertSee('Nombre');
    }

    /** @test */
    function it_create_a_new_management()
    {
        $this->post(route('management.store'), $this->getManagementData())
            ->assertRedirect(route('managements'));
        
        $this->assertDatabaseHas('managements', [
            'acronym'   => 'PAPO',
            'name'      => 'Pa los que quieren',
            ]);
    }

    /** @test */
    function the_acronym_is_required()
    {
        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'acronym' => '',
                'name'    => 'Pa los que quieren',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['acronym']);
    
        $this->assertDatabaseMissing('managements', [
            'acronym' => '',
            'name'    => 'Pa los que quieren',
            ]);
    }


    /** @test */
    function the_acronym_must_only_contain_alpha_characters_and_one_word()
    {
        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'acronym' => 'PA+PO',
                'name'    => 'Pa los que quieren',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['acronym']);
    
        $this->assertDatabaseMissing('managements', [
            'acronym' => 'PA+PO',
            'name'    => 'Pa los que quieren',
            ]);

        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'acronym' => 'PA PO',
                'name'    => 'Pa los que quieren',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['acronym']);
    
        $this->assertDatabaseMissing('managements', [
            'acronym' => 'PA PO',
            'name'    => 'Pa los que quieren',
            ]);
        
    }

    /** @test */
    function the_acronym_must_be_unique()
    {
        factory(Management::class)->create([
            'acronym' => 'PAPO',
        ]);

        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'acronym' => 'PAPO',
                'name'    => 'Pa los que quieren',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['acronym']);
    
        $this->assertSame(1, Management::where('acronym','PAPO')->count());
    }

    /** @test */
    function the_acronym_must_legth_6_characters()
    {

        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'acronym' => 'PAPOPE1',
                'name'    => 'Pa los que quieren',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['acronym']);
        
        $this->post(route('management.store'), $this->getManagementData([
            'acronym' => 'PAPOTE',
            'name'    => 'Pa los que quieren',
            ]))->assertRedirect(route('managements'));
        
        $this->assertDatabaseHas('managements', [
            'acronym'   => 'PAPOTE',
            'name'      => 'Pa los que quieren',
            ]);
    }

    /** @test */
    function the_management_name_is_required()
    {
        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'acronym' => 'PAPO',
                'name'    => '',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('managements', [
            'acronym' => 'PAPO',
            'name'    => '',
            ]);
    }

    /** @test */
    function the_management_name_must_be_unique()
    {
        factory(Management::class)->create([
            'name' => 'Proyectos Internacionales',
        ]);

        $this->from(route('management.create'))
            ->post(route('management.store'), $this->getManagementData([
                'name' => 'Proyectos Internacionales',
                ]))
            ->assertRedirect(route('management.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertSame(1, Management::where('name','Proyectos Internacionales')->count());
    }
       
}