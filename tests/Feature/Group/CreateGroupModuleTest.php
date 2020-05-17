<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\{Group,  Coordination};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGroupModuleTest extends TestCase
{
    use RefreshDatabase;

    // /** @test */
    // function it_loads_the_create_groups_page()
    // {
    //     $this->get(route('group.create'))
    //         ->assertStatus(200)
    //         ->assertViewIs('group.create')
    //         ->assertSee(trans('titles.group.create'))
    //         ->assertSee('Nombre');
    // }

    /** @test */
    function it_create_a_new_group()
    {
        $this->post(route('group.store'), $this->getGroupData())
            ->assertRedirect(route('groups'));
        
        $this->assertDatabaseHas('groups', [
            'name'          => 'Despacho',
            'description'   => 'Operaciones de desapcho',
            'coordination_id'  =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ]);
    }

    /** @test */
    function the_group_name_is_required()
    {
        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'name'    => '',
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertDatabaseMissing('groups', [
            'name'    => '',
            ]);
    }

    /** @test */
    function the_group_name_must_be_unique()
    {
        
        factory(Group::class)->create([
            'name' => 'Logistica',
        ]);

        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'name'    => 'Logistica',
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['name']);
    
        $this->assertSame(1, Group::where('name','Logistica')->count());
    }

    /** @test */
    function the_group_name_must_legth_25_characters()
    {

        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'name'    => 'AAAAAAAAAAAAAAAAAAAAAAAAAA',
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['name']);
        
        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'name'    => 'AAAAAAAAAAAAAAAAAAAAAAAAA',
                ]))
            ->assertRedirect(route('groups'));
        
        $this->assertDatabaseHas('groups', [
            'name'    => 'AAAAAAAAAAAAAAAAAAAAAAAAA',
            ]);
    }

    /** @test */
    function the_group_description_is_required()
    {
        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'description' => '',
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['description']);
    
        $this->assertDatabaseMissing('groups', [
            'description' => '',
            ]);
    }

    /** @test */
    function the_group_description_of_must_have_more_than_50_characters()
    {
        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['description']);
    
        $this->assertDatabaseMissing('groups', [
            'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm1',
            ]);
    
            $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
                ]))
            ->assertRedirect(route('groups'));
    
        $this->assertDatabaseHas('groups', [
            'description' => 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
            ]);
    }

    /** @test */
    function the_coordination_id_is_required()
    {
        $this->from(route('group.create'))
            ->post(route('group.store'), [
                'name'        => 'Distribucion',
                'description' => 'Actividades logsiticas',
            ])
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['coordination']);
    
        $this->assertDatabaseMissing('groups', [
            'name'        => 'Distribucion',
            'description' => 'Actividades logsiticas',
            ]);
    }

    /** @test */
    function the_coordination_id_must_be_valid()
    {
        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'coordination' => '999',
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['coordination']);
    
        $this->assertDatabaseMissing('groups', [
            'name'          => 'Despacho',
            'description'   => 'Operaciones de desapcho',
            'coordination_id' =>  999,
            ]);
    }

    /** @test */
    function only_active_coordination_are_valid()
    {
        $coordination = factory(Coordination::class)->create([
            'active'    => false,
        ]);

        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'coordination' => $coordination->id,
                ]))
            ->assertRedirect(route('group.create'))
            ->assertSessionHasErrors(['coordination']);
    
        $this->assertDatabaseMissing('groups', [
            'name'          => 'Despacho',
            'description'   => 'Operaciones de desapcho',
            'coordination_id' =>  $coordination->id,
            ]);
        
            $coordination = factory(Coordination::class)->create();
        
        $this->from(route('group.create'))
            ->post(route('group.store'), $this->getGroupData([
                'coordination' => $coordination->id,
                ]))
            ->assertRedirect(route('groups'));

        $this->assertDatabaseHas('groups', [
            'name'          => 'Despacho',
            'description'   => 'Operaciones de desapcho',
            'coordination_id' =>  $coordination->id,
            ]);
    }
       
}