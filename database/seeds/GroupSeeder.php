<?php

use Illuminate\Database\Seeder;
use App\Model\{ Group, Coordination};



class GroupSeeder extends Seeder
{
    protected $coordinations;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Group::class)->create([
            'name'              => 'Líneas',
            'description'       => 'Líneas de Producción',
            'coordination_id'   => Coordination::where('name','Producción')->first()->id,
        ]);

        factory(Group::class)->create([
            'name' => 'Soporte',
            'description' => 'Soporte de Maquinas',
            'coordination_id'   => Coordination::where('name','Producción')->first()->id,
        ]);

        factory(Group::class)->create([
            'name' => 'Despacho',
            'description' => 'Despacho y carga',
            'coordination_id'   => Coordination::where('name','Operaciones')->first()->id,
        ]);

        factory(Group::class)->times(10)->create();
    }
}
