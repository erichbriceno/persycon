<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Coordination, Management};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCoordinationModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_create_coordinations_page()
    {
        $this->get(route('coordination.create'))
            ->assertStatus(200)
            ->assertViewIs('coordination.create')
            ->assertSee(trans('titles.coordination.create'))
            ->assertSee('Nombre')
            ->assertSee('Descripción')
            ->assertSee('Gerencia');
    }

    /** @test */
    function it_create_a_new_coordination()
    {
        $this->post(route('coordination.store'), $this->getCoordinationData())
            ->assertRedirect(route('coordinations'));
        
        $this->assertDatabaseHas('coordinations', [
            'name'          => 'Lineas',
            'description'   => 'Lineas de producción',
            'active' => true
            ]);
    }

    /** @test */
    function the_name_coordination_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'name' => '',
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('coordinations', [
            'name'          => '',
            'description'   => 'Lineas de producción',
            'active' => true
            ]);
    }

    /** @test */
    function the_name_of_must_have_more_than_25_characters()
    {
        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'name' => 'hhhhhhhhhhhhhhhhh hhhhhhhhh',
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('coordinations', [
            'name'          => 'hhhhhhhhhhhhhhhhh hhhhhhhhh',
            'description'   => 'Lineas de producción',
            'active' => true
            ]);

        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'name' => 'hhhhhhhhhh hhhhhhhhhhhhhh',
                ]))
            ->assertRedirect(route('coordinations'));
    
        $this->assertDatabaseHas('coordinations', [
            'name'          => 'hhhhhhhhhh hhhhhhhhhhhhhh',
            'description'   => 'Lineas de producción',
            'active' => true
            ]);
    }

    /** @test */
    function the_name_coordination_must_be_unique()
    {
        factory(Coordination::class)->create([
            'name' => 'Lineas',
        ]);

        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'name' => 'Lineas',
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['name']);
            
        $this->assertSame(1, Coordination::where('name','Lineas')->count());
    }

    /** @test */
    function the_description_coordination_is_required()
    {
        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'description' => '',
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['description']);
    
        $this->assertDatabaseMissing('coordinations', [
            'name'          => 'Lineas',
            'description'   => '',
            'active'        => true
            ]);
    }

    /** @test */
    function the_description_coordination_of_must_have_more_than_50_characters()
    {
        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['description']);
    
        $this->assertDatabaseMissing('coordinations', [
            'name'          => 'Lineas',
            'description'   => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
            'active'        => true
            ]);
    
        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
                ]))
            ->assertRedirect(route('coordinations'));
    
        $this->assertDatabaseHas('coordinations', [
            'name'          => 'Lineas',
            'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
            'active' => true
            ]);
    }

    /** @test */
    function the_managenent_id_must_be_valid()
    {
        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'management' => '999',
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['management']);
    
        $this->assertDatabaseMissing('coordinations', [
            'name'          => 'Lineas',
            'description'   => 'Lineas de producción',
            'management_id' =>  999,
            'active'        => true
            ]);
    }

    /** @test */
    function only_active_management_are_valid()
    {
        $management = factory(Management::class)->create([
            'active'    => false,
        ]);

        $this->from(route('coordination.create'))
            ->post(route('coordination.store'), $this->getCoordinationData([
                'management' => $management->id,
                ]))
            ->assertRedirect(route('coordination.create'))
            ->assertSessionHasErrors(['management']);
    
        $this->assertDatabaseMissing('coordinations', [
            'name'          => 'Lineas',
            'description'   => 'Lineas de producción',
            'management_id' =>  $management->id,
            'active'        => true
            ]);
        
        $management = factory(Management::class)->create();
        
        $this->from(route('coordination.create'))
        ->post(route('coordination.store'), $this->getCoordinationData([
            'management' => $management->id,
            ]))
        ->assertRedirect(route('coordinations'));

        $this->assertDatabaseHas('coordinations', [
            'name'          => 'Lineas',
            'description'   => 'Lineas de producción',
            'management_id' =>  $management->id,
            'active'        => true
            ]);
        }
    
}