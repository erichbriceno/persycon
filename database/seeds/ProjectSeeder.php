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
        $project = factory(Project::class)->create([
            'name' => 'Elecciones 2019',
            'description' => 'Elecciones Regionales 2019',
            'active' => true,
        ]);

        $project->categories()->createMany([
            [
                'name'      => 'T1',
                'minimum'   =>  5,
                'maximum'   =>  39,
            ],[
                'name'      => 'T2',
                'minimum'   =>  40,
                'maximum'   =>  59,
            ],[
                'name'      => 'T3',
                'minimum'   =>  60,
                'maximum'   =>  79,
            ],[
                'name'      => 'T4',
                'minimum'   =>  80,
                'maximum'   =>  99,
            ],
        ]);

        $project = factory(Project::class)->create([
            'name' => 'Mantenimiento 2020',
            'description' => 'Mantenimiento de la Plataforma 2020',
            'active' => true,
        ]);
        
        $project->categories()->createMany([
            [
                'name'      => 'T1',
                'minimum'   =>  5,
                'maximum'   =>  39,
            ],[
                'name'      => 'T2',
                'minimum'   =>  40,
                'maximum'   =>  59,
            ],[
                'name'      => 'T3',
                'minimum'   =>  60,
                'maximum'   =>  79,
            ],[
                'name'      => 'T4',
                'minimum'   =>  80,
                'maximum'   =>  99,
            ],
        ]);

        foreach (range(1, 10) as $i) {
            $this->createRandomProject();
        }
    }

    public function createRandomProject(): void
    {
        $project = factory(Project::class)->create();
        
        $project->categories()->createMany([
            [
                'name'      => 'T1',
                'minimum'   =>  rand(1, 10),
                'maximum'   =>  rand(11, 39),
            ],[
                'name'      => 'T2',
                'minimum'   =>  rand(40, 45),
                'maximum'   =>  rand(55, 59),
            ],[
                'name'      => 'T3',
                'minimum'   =>  rand(60, 70),
                'maximum'   =>  rand(75, 79),
            ],[
                'name'      => 'T4',
                'minimum'   =>  rand(81, 90),
                'maximum'   =>  rand(91, 99),
            ],
        ]);
    }
}