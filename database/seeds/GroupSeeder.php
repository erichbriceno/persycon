<?php

use App\Model\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Group::class)->create([
            'name' => 'Líneas',
            'description' => 'Líneas de Producción',
        ]);

        factory(Group::class)->create([
            'name' => 'Soporte',
            'description' => 'Soporte de Maquinas',
        ]);

        factory(Group::class)->create([
            'name' => 'Despacho',
            'description' => 'Despacho y carga',
        ]);

        factory(Group::class)->times(10)->create();
    }
}
