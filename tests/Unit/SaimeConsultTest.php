<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Cedulate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaimeConsultTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_returns_a_cedulate_names_when_consulted()
    {
        $this->createErichSaime();

        $person = Cedulate::where('letra','V')
            ->where('numerocedula', '13683474')
            ->first();

        $this->assertSame('ERICH JAVIER', $person->names);
        $this->assertSame('ERICH JAVIER BRICENO FERNANDEZ', $person->name);
    }

    /** @test */
    function it_returns_a_cedulate_idPerson_when_consulted()
    {
        $this->createErichSaime();

        $person = Cedulate::where('letra','V')
            ->where('numerocedula', '13683474')
            ->first();

        $this->assertSame('V13683474', $person->cedule);
    }




    public function createErichSaime(): void
    {
        factory(Cedulate::class)->create([
            'idpersona' => 'FESASATE335',
            'letra' => 'V',
            'numerocedula' => 13683474,
            'primernombre' => 'ERICH',
            'segundonombre' => 'JAVIER',
            'primerapellido' => 'BRICENO',
            'segundoapellido' => 'FERNANDEZ',
            'fechanacimiento' => '1978-09-06',
            'sexo' => 'm',
        ]);
    }
}
