<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{ Coordination, Management };
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCoordinationModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_update_a_coordination_allowed_fields()
    {
        $coordination = factory(Coordination::class)->create();
        
        $this->put(route('coordination.update', $coordination),
            [
                'name'          => 'Lineas',
                'description'   => 'Lineas de producción',
                'management'    =>  Management::Where('name', 'Mariche')->first()->id,
                'active'        =>  true
            ])->assertRedirect(route('coordinations'));
        
        $this->assertDatabaseHas('coordinations', [
            'name'          => 'Lineas',
            'description'    => 'Lineas de producción',
            ]);
    }

    /** @test */
    function the_name_cant_be_null_when_updating_a_coordination()
    {
        $coordination = factory(Coordination::class)->create();
                
        $this->from(route('coordination.edit', $coordination))
            ->put(route('coordination.update', $coordination),
            [
                'name'          => '',
                'description'   => 'Lineas de producción',
                'management'    =>  Management::Where('name', 'Mariche')->first()->id,
                'active'        =>  true
            ])->assertRedirect(route('coordination.edit', $coordination))
            ->assertSessionHasErrors(['name']);
        
        $this->assertDatabaseMissing('coordinations', [
            'name'          => '',
            'description'   => 'Lineas de producción',
            'management_id'    =>  Management::Where('name', 'Mariche')->first()->id,
            'active'        =>  true
            ]);

        $this->from(route('coordination.edit', $coordination))
        ->put(route('coordination.update', $coordination),
        [
            'name'          => null,
            'description'   => 'Lineas de producción',
            'management'    =>  Management::Where('name', 'Mariche')->first()->id,
            'active'        =>  true
        ])->assertRedirect(route('coordination.edit', $coordination))
        ->assertSessionHasErrors(['name']);
        
        $this->assertDatabaseMissing('coordinations', [
            'name'          => null,
            'description'   => 'Lineas de producción',
            'management_id'    =>  Management::Where('name', 'Mariche')->first()->id,
            'active'        =>  true
            ]);
    }

    /** @test */
    function the_name_can_be_kept_when_the_coordination_is_updated()
    {
        $coordination = factory(Coordination::class)->create([
            'name'          => 'Lineas',
        ]);
                
        $this->from(route('coordination.edit', $coordination))
            ->put(route('coordination.update', $coordination),
            [
                'name'          => 'Lineas',
                'description'   => 'Lineas de producción',
                'management'    =>  Management::Where('name', 'Mariche')->first()->id,
                'active'        =>  true
            ])->assertRedirect(route('coordinations'));
        
        $this->assertDatabaseHas('coordinations', [
            'name'          => 'Lineas',
            'description'   => 'Lineas de producción',
            'management_id' =>  Management::Where('name', 'Mariche')->first()->id,
            'active'        =>  true
            ]);
    }
}