<?php

use App\Model\Cedulate;
use Illuminate\Database\Seeder;

class CedulateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE335',
            'letra' =>  'V',
            'numerocedula' => 13683474,
            'primernombre' => 'ERICH',
            'segundonombre' => 'JAVIER',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1978-09-06',
            'sexo' =>   'm',
        ]);

        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE336',
            'letra' =>  'V',
            'numerocedula' => 16638933,
            'primernombre' => 'DANIEL',
            'segundonombre' => 'JOSE',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1983-03-07',
            'sexo' =>   'm',
        ]);

        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE337',
            'letra' =>  'V',
            'numerocedula' => 16638929,
            'primernombre' => 'ANA',
            'segundonombre' => 'LISBETH KARINA',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1984-10-20',
            'sexo' =>   'f',
        ]);

        factory(Cedulate::class)->times(50)->create();

    }
}
