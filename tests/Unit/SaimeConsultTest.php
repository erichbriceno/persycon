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
        $person = Cedulate::where('letra','V')
            ->where('numerocedula', '13683474')
            ->first();

        $this->assertSame('ERICH JAVIER', $person->names);
        $this->assertSame('ERICH JAVIER BRICENO FERNANDEZ', $person->name);
    }

    /** @test */
    function it_returns_a_cedulate_idPerson_when_consulted()
    {
        $person = Cedulate::where('letra','V')
            ->where('numerocedula', '13683474')
            ->first();

        $this->assertSame('V13683474', $person->cedule);
    }


}
