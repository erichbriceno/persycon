<?php

namespace Tests\Feature\Feature\Coordination;

use Tests\TestCase;
use App\Model\Coordination;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class DeleteCoordinationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function it_sends_a_coordination_to_the_trash()
    {
        $coordination = factory(Coordination::class)->create([
            'name' => ''
        ]);

        $this->patch(route('coordination.trash', $coordination))
            ->assertRedirect(route('coordinations'));

        $this->assertSoftDeleted('coordinations', [
                'id' => $coordination->id,
            ]);

        $this->assertSame(0, Coordination::all()->count());
            
        $coordination->refresh();
        $this->assertTrue($coordination->trashed());
    }

    /** @test */
    function it_shows_the_trashed_coordinations_list()
    {
        factory(Coordination::class)->create([
            'name' => 'Operaciones',
        ]);

        $coordination = factory(Coordination::class)->create([
            'name' => 'Lineas',
            'description' => 'Lineas de producción',
        ]);


        $this->patch(route('coordination.trash', $coordination))
            ->assertRedirect(route('coordinations'));
        
        $this->get(route('coordinations.trash'))
             ->assertStatus(200)
             ->assertSee(trans('titles.coordination.trash'))
             ->assertSee('Lineas')
             ->assertDontSee('Operaciones');
    }

        /** @test */
        function it_restores_a_coordination_from_the_trash()
        {
            $coordination = factory(Coordination::class)->create([
                'name' => 'Lineas',
                'description' => 'Lineas de producción',
                'deleted_at' => now()
            ]);
    
            $this->patch(route('coordination.restore', $coordination))
                ->assertRedirect(route('coordinations.trash'))
                ->assertDontSee('Lineas');
    
            $this->assertDatabaseHas('coordinations', [
                'name' => 'Lineas',
                'deleted_at' => null,
            ]);
    
            $this->get(route('coordinations'))
                ->assertSee('Lineas');
        }

    /** @test */
    function it_completely_deletes_a_coordination()
    {
        $coordination = factory(Coordination::class)->create([
            'name' => 'Lineas',
            'deleted_at' => now(),
        ]);

        $this->delete(route('coordination.destory', $coordination))
            ->assertRedirect(route('coordinations.trash'));

        $this->assertDatabaseMissing('coordinations', [
            'name' => 'Lineas',
        ]);
    }
}
