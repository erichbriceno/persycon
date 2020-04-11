<?php

use App\Model\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class)->create([
            'name' => 'Elecciones 2019',
            'description' => 'Elecciones Regionales 2019',
            'active' => true,
        ]);

        factory(Project::class)->create([
            'name' => 'Mantenimiento 2020',
            'description' => 'Mantenimiento de la Plataforma 2020',
            'active' => true,
        ]);

        factory(Project::class)->times(10)->create();

    }
}
