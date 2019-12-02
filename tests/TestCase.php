<?php

namespace Tests;

use App\Model\{Role, Management};
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /****************** Complementos **************/


    public function setUp() :void
    {
        parent::setUp();

        $this->loadRolesTable();
        $this->loadManagemetsTable();
    }

    protected function getValidData(array $custom = [])
    {

        return array_merge([
            'nat' => 'V',
            'numberced' => '13683474',
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('name', 'User')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
            'password' => 'secreto1',
            'password_confirmation' => 'secreto1',
            'state' => 'active'
        ], $custom);

    }

    protected function loadRolesTable()
    {

        factory(Role::class)->create([
            'name' => 'Master',
            'selectable' => false
        ]);

        factory(Role::class)->create([
            'name' => 'Administrator',
        ]);

        factory(Role::class)->create([
            'name' => 'User',
        ]);

    }

    public function loadManagemetsTable()
    {
        factory(Management::class)->create([
            'name' => 'Unassigned',
            'description' => '',
            'selectable' => false
        ]);

        factory(Management::class)->create([
            'name' => 'All',
            'description' => 'Master Administrator',
        ]);

        factory(Management::class)->create([
            'name' => 'Mariche',
            'description' => 'Galpon CNE Mariche',
        ]);

        factory(Management::class)->create([
            'name' => 'CNS',
            'description' => 'Centro Nacional de Soporte',
        ]);

        factory(Management::class)->create([
            'name' => 'ODC',
            'description' => 'Oficinas Decentralizadas',
        ]);
    }

}
