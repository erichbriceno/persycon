<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{ Group, Coordination };
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateGroupModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_update_a_group_allowed_fields()
    {
        $group = factory(Group::class)->create();
        
        $this->put(route('group.update', $group),
            [
                'name'          => 'Despacho',
                'description'   => 'Operaciones de desapcho',
                'coordination'  =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ])->assertRedirect(route('groups'));
        
        $this->assertDatabaseHas('groups', [
            'name'              => 'Despacho',
            'description'       => 'Operaciones de desapcho',
            'coordination_id'   =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ]);
    }

    /** @test */
    function the_name_cant_be_null_when_updating_a_group()
    {
        $group = factory(Group::class)->create();
                
        $this->from(route('group.edit', $group))
            ->put(route('group.update', $group),
            [
                'name'          => '',
                'description'   => 'Operaciones de desapcho',
                'coordination'  =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ])
            ->assertRedirect(route('group.edit', $group))
            ->assertSessionHasErrors(['name']);
        
        $this->assertDatabaseMissing('groups', [
            'name'              => '',
            'description'       => 'Operaciones de desapcho',
            'coordination_id'   =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ]);

        $this->from(route('group.edit', $group))
            ->put(route('group.update', $group),
            [
                'name'          => null,
                'description'   => 'Operaciones de desapcho',
                'coordination'  =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ])
            ->assertRedirect(route('group.edit', $group))
            ->assertSessionHasErrors(['name']);
        
        $this->assertDatabaseMissing('groups', [
            'name'              => null,
            'description'       => 'Operaciones de desapcho',
            'coordination_id'   =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ]);
    }

    /** @test */
    function the_name_can_be_kept_when_the_group_is_updated()
    {
        $group = factory(Group::class)->create([
            'name'          => 'Despacho',
        ]);

        $this->from(route('group.edit', $group))
        ->put(route('group.update', $group),
        [
            'name'          => 'Despacho',
            'description'   => 'Operaciones de desapcho',
            'coordination'  =>  Coordination::Where('name', 'Operaciones')->first()->id,
        ])
        ->assertRedirect(route('groups'));
    
        $this->assertDatabaseHas('groups', [
            'name'              => 'Despacho',
            'description'       => 'Operaciones de desapcho',
            'coordination_id'   =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ]);
    }
}