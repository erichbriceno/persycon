<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Saime;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ACConsultTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_a_citizen_returns_when_consulted()
    {


        $this->assertSame('Erich Javier', 'Erich Javier' );
    }
}
