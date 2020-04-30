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
            'acronym'   => 'PO',
            'name'      => 'Gerencia de Proyectos',
            'description' => 'Master Administrator',
        ]);

        factory(Management::class)->create([
            'acronym'   => 'PE',
            'name'      => 'Mariche',
            'description' => 'Galpon CNE Mariche',
        ]);

        factory(Management::class)->create([
            'acronym'   => 'CNS',
            'name'      => 'Centro Nacional de Soporte',
            'description' => 'Centro Nacional de Soporte',
        ]);

        factory(Management::class)->create([
            'acronym'   => 'ODC',
            'name' => 'Oficinas Decentralizadas',
            'description' => 'Oficinas Decentralizadas',
        ]);

        factory(Management::class)->times(2)->create();
        
    }
}
