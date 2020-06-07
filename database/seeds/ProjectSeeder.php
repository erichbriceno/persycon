<?php

use App\Model\{ Project, Category};
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
        $categories = Category::all();

        $project = factory(Project::class)->create([
            'name' => 'Elecciones 2019',
            'description' => 'Elecciones Regionales 2019',
            'active' => true,
        ]);
        $project->categories()->save($categories->where('name','T1')->first(), [ 'minimum' => '5.00', 'maximum' => '39.00']);
        $project->categories()->save($categories->where('name','T2')->first(), [ 'minimum' => '40.00', 'maximum' => '59.00']);
        $project->categories()->save($categories->where('name','T3')->first(), [ 'minimum' => '60.00', 'maximum' => '79.00']);
        $project->categories()->save($categories->where('name','T4')->first(), [ 'minimum' => '80.00', 'maximum' => '99.00']);
        
        $project = factory(Project::class)->create([
            'name' => 'Mantenimiento 2020',
            'description' => 'Mantenimiento de la Plataforma 2020',
            'active' => true,
        ]);
        $project->categories()->save($categories->where('name','T1')->first(), [ 'minimum' => '5.00', 'maximum' => '39.00']);
        $project->categories()->save($categories->where('name','T2')->first(), [ 'minimum' => '40.00', 'maximum' => '59.00']);
        $project->categories()->save($categories->where('name','T3')->first(), [ 'minimum' => '60.00', 'maximum' => '79.00']);
        $project->categories()->save($categories->where('name','T4')->first(), [ 'minimum' => '80.00', 'maximum' => '99.00']);
        
        foreach (range(1, 10) as $i) {
            $this->createRandomProject();
        }
    }

    public function createRandomProject(): void
    {
        $categories = Category::all();
        
        $project = factory(Project::class)->create();
        $project->categories()->save($categories->where('name','T1')->first(), [ 'minimum' => '5.00', 'maximum' => '39.00']);
        $project->categories()->save($categories->where('name','T2')->first(), [ 'minimum' => '40.00', 'maximum' => '59.00']);
        $project->categories()->save($categories->where('name','T3')->first(), [ 'minimum' => '60.00', 'maximum' => '79.00']);
        $project->categories()->save($categories->where('name','T4')->first(), [ 'minimum' => '80.00', 'maximum' => '99.00']);
        
    }
}