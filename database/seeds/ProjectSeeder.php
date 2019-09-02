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
        ]);


        factory(Project::class)->times(10)->create();

    }
}
