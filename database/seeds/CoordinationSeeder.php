<?php

use Illuminate\Database\Seeder;
use App\Model\{ Coordination, Management};


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
            'management_id' => Management::Where('acronym', 'PE')->first()->id,
            'active' => true,
        ]);

        factory(Coordination::class)->times(10)->create();

    }
}
