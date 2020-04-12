<?php

use App\Model\Coordination;
use Illuminate\Database\Seeder;

class CoordinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Coordination::class)->create([
            'name'        => 'Operaciones',
            'description' => 'Actividades logsiticas',
            'active' => true,
        ]);

        factory(Coordination::class)->times(10)->create();

    }
}
