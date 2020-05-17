<?php

namespace Tests;

use App\Model\{Cedulate, Role, Management, Coordination, Project};
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /****************** Complementos **************/
    // $this->withoutExceptionHandling();

    public function setUp() :void
    {
        parent::setUp();

        $this->loadRolesTable();
        $this->loadManagemetsTable();
        $this->loadCoordinationsTable();
        $this->loadCedulatesTable();
    }

    protected function getValidData(array $custom = [])
    {
        return array_merge([
            'cedule' => 'V13683474',
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role' => Role::Where('name', 'User')->first()->id,
            'management' => Management::Where('name', 'All')->first()->id,
            'password' => 'secreto1',
            'password_confirmation' => 'secreto1',
            'state' => 'active'
        ], $custom);
    }

    protected function getProjectData(array $custom = [])
    {
        return array_merge([
                'name' => 'Municipales',
                'year' => '2020',
                'description' => 'Elecciones Municipales 2020',
                'from' => '20/03/2020',
                'active' => true,
            ], $custom);
    }

    public function createRandomProject()
    {
        $project = factory(Project::class)->create([
            'name' => 'Proyecto 2020',
        ]);
        
        $project->categories()->createMany([
            [
                'name'      => 'T1',
                'minimum'   =>  1,
                'maximum'   =>  9,
            ],[
                'name'      => 'T2',
                'minimum'   =>  10,
                'maximum'   =>  19
            ],[
                'name'      => 'T3',
                'minimum'   =>  20,
                'maximum'   =>  29,
            ],[
                'name'      => 'T4',
                'minimum'   =>  30,
                'maximum'   =>  39,
            ],
        ]);

        return $project;
    }

    protected function getManagementData(array $custom = [])
    {
        return array_merge([
                'acronym'   => 'PAPO',
                'name'      => 'Pa los que quieren',
            ], $custom);
    }

    protected function getCoordinationData(array $custom = [])
    {
        return array_merge([
                'name'          => 'Lineas',
                'description'   => 'Lineas de producción',
                'management' =>  Management::Where('name', 'Mariche')->first()->id,
                'active'        => true,
            ], $custom);
    }

    protected function getGroupData(array $custom = [])
    {
        return array_merge([
                'name'          => 'Despacho',
                'description'   => 'Operaciones de desapcho',
                'coordination'  =>  Coordination::Where('name', 'Operaciones')->first()->id,
            ], $custom);
    }

    protected function getUpdateValidData(array $custom = [])
    {
        return array_merge([
            'email' => 'erichbriceno@gmail.com',
            'role' => Role::Where('name', 'User')->first()->id,
            'management' => Management::Where('name', 'All')->first()->id,
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

    protected function loadCategoriesEmpty(Project $project)
    {
        $project->categories()->createMany([
            ['name' => 'T1', 'minimum' => 0, 'maximum' => 0],
            ['name' => 'T2', 'minimum' => 0, 'maximum' => 0],
            ['name' => 'T3', 'minimum' => 0, 'maximum' => 0],
            ['name' => 'T4', 'minimum' => 0, 'maximum' => 0],
        ]);
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
            'active' => false
        ]);

        factory(Management::class)->create([
            'name' => 'All',
            'description' => 'Master Administrator',
            'active' => true,
        ]);

        factory(Management::class)->create([
            'acronym'   => 'PE',
            'name'      => 'Mariche',
            'description' => 'Galpon CNE Mariche',
            'active' => true,
        ]);

        factory(Management::class)->create([
            'acronym'   => 'CNS',
            'name'      => 'Centro Nacional de Soporte',
            'description' => 'Centro Nacional de Soporte',
            'active' => true,
        ]);

        factory(Management::class)->create([
            'acronym'   => 'ODC',
            'name'      => 'Oficinas Decentralizadas',
            'description' => 'Oficinas Decentralizadas',
            'active' => true,
        ]);
    }

    public function loadCoordinationsTable()
    {
        factory(Coordination::class)->create([
            'name'        => 'Operaciones',
            'description' => 'Actividades logsiticas',
            'management_id' => Management::where('acronym', 'PE')->first()->id,
            'active' => true,
        ]);

        factory(Coordination::class)->create([
            'name'        => 'Producción',
            'description' => 'Actividades de producción',
            'management_id' => Management::where('acronym', 'PE')->first()->id,
            'active' => true,
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

        factory(Cedulate::class)->create([
            'letra' =>  'E',
            'numerocedula' => 13683475,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'V',
            'numerocedula' => 300000,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'V',
            'numerocedula' => 90000000,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'E',
            'numerocedula' => 300000,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'E',
            'numerocedula' => 90000000,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'V',
            'numerocedula' => 2,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'V',
            'numerocedula' => 299999,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'V',
            'numerocedula' => 90000001,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'E',
            'numerocedula' => 299999,
        ]);

        factory(Cedulate::class)->create([
            'letra' =>  'E',
            'numerocedula' => 90000001,
        ]);

    }

}
