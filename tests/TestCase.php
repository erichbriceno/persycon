<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Model\{Cedulate, Category, Role, Management, Coordination, Project, SalaryType};

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
        $this->loadSalaryTypesTable();
        $this->loadCategories();

    }

    
    public function createRandomProject($name = 'Proyecto 2020' )
    {
        $categories = Category::all();

        $project = factory(Project::class)->create([
            'name' => $name,
        ]);
        
        $project->categories()->save($categories->where('name','T1')->first(), [ 'minimum' => '5.00', 'maximum' => '39.00']);
        $project->categories()->save($categories->where('name','T2')->first(), [ 'minimum' => '40.00', 'maximum' => '59.00']);
        $project->categories()->save($categories->where('name','T3')->first(), [ 'minimum' => '60.00', 'maximum' => '79.00']);
        $project->categories()->save($categories->where('name','T4')->first(), [ 'minimum' => '80.00', 'maximum' => '99.00']);
        
        return $project;
    }

    protected function getCustomCategoriesData(array $custom = [])
    {
        return array_merge([
            'min1' => 2,
            'max1' => 19,
            'min2' => 20,
            'max2' => 39,
            'min3' => 40,
            'max3' => 59,
            'min4' => 60,
            'max4' => 79,
        ], $custom);
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

    protected function loadCategories()
    {
        factory(Category::class)->create([ 'name'  => 'T1' ]);
        factory(Category::class)->create([ 'name'  => 'T2' ]);
        factory(Category::class)->create([ 'name'  => 'T3' ]);
        factory(Category::class)->create([ 'name'  => 'T4' ]);
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

    public function loadSalaryTypesTable()
    {
        factory(SalaryType::class)->create([
            'name' => 'Diario',
            'description' => 'Salario diario',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Semanal',
            'description' => 'Salario semanal',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Mensual',
            'description' => 'Salario mensual',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Mixto',
            'description' => 'Salario mixto',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Único',
            'description' => 'Compensación única',
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
