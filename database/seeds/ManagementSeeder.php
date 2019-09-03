<?php

use App\Model\Management;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Management::class)->create([
            'name' => 'Mariche',
            'description' => 'Galpon CNE Mariche',
        ]);

        factory(Management::class)->create([
            'name' => 'CNS',
            'description' => 'Centro Nacional de Soporte	',
        ]);

        factory(Management::class)->create([
            'name' => 'ODC',
            'description' => 'Oficinas Decentralizadas',
        ]);


        factory(Management::class)->times(10)->create();
    }
}
