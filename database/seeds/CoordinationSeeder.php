<?php

use Illuminate\Database\Seeder;
use App\Model\{ Coordination, Management};


class CoordinationSeeder extends Seeder
{
    protected $managements;
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
            'management_id' => Management::where('acronym', 'PE')->first()->id,
            'active' => true,
        ]);

        factory(Coordination::class)->create([
            'name'        => 'Producción',
            'description' => 'Actividades de producción',
            'management_id' => Management::where('acronym', 'PE')->first()->id,
            'active' => true,
        ]);

        factory(Coordination::class)->times(10)->create();

    }

}
