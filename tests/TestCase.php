<?php

namespace Tests;

use App\Model\Role;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /****************** Complementos **************/


    public function setUp() :void
    {
        parent::setUp();

        //$this->withoutExceptionHandling();

        //$this->loadRolesTable();
    }

    protected function getValidData(array $custom = [])
    {

        return array_merge([
            'first_name' => 'Erich',
            'last_name' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'password' => 'secreto1',
            'role_id' => Role::Where('description', 'User')->first()->id,
        ], $custom);

    }

    protected function loadRolesTable()
    {

        factory(Role::class)->create([
            'description' => 'Master',
            'selectable' => false
        ]);

        factory(Role::class)->create([
            'description' => 'Administrator',
        ]);

        factory(Role::class)->create([
            'description' => 'User',
        ]);

    }
}
