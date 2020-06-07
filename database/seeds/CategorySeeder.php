<?php

use App\Model\{Category};
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create([
            'name'  => 'T1',
        ]);

        factory(Category::class)->create([
            'name'  => 'T2',
        ]);

        factory(Category::class)->create([
            'name'  => 'T3',
        ]);

        factory(Category::class)->create([
            'name'  => 'T4',
        ]);
    }
}
