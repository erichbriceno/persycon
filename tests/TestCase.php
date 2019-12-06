<?php

namespace Tests;

use App\Model\{Cedulate, Role, Management};
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
        $this->loadCedulatesTable();
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

    protected function getUpdateValidData(array $custom = [])
    {
        return array_merge([
            'email' => 'erichbriceno@gmail.com',
            'role_id' => Role::Where('name', 'User')->first()->id,
            'management_id' => Management::Where('name', 'All')->first()->id,
            'password' => 'secreto1',
            'password_confirmation' => 'secreto1',
            'state' => 'active'
        ], $custom);
    }

    protected function getCeduleValidData(array $custom = [])
    {
        return array_merge([
            'idpersona' => 'FESASATE335',
            'letra' =>  'V',
            'numerocedula' => '13683474',
            'primernombre' => 'ERICH',
            'segundonombre' => 'JAVIER',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1978-09-06',
            'sexo' =>   'm',
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

    public function loadCedulatesTable()
    {
        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE335',
            'letra' =>  'V',
            'numerocedula' => 13683474,
            'primernombre' => 'ERICH',
            'segundonombre' => 'JAVIER',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1978-09-06',
            'sexo' =>   'm',
        ]);

        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE336',
            'letra' =>  'V',
            'numerocedula' => 16638933,
            'primernombre' => 'DANIEL',
            'segundonombre' => 'JOSE',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1983-03-07',
            'sexo' =>   'm',
        ]);

        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE337',
            'letra' =>  'V',
            'numerocedula' => 16638929,
            'primernombre' => 'ANA',
            'segundonombre' => 'LISBETH KARINA',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1984-10-20',
            'sexo' =>   'f',
        ]);

    }

}
