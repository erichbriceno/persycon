<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rules\ValidCedule;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidCeduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function validates_cedules_values()
    {
        $rule = new ValidCedule;

        $this->assertTrue($rule->passes('cedule', 'V13683474'));
        $this->assertTrue($rule->passes('cedule', 'E13683475'));
        $this->assertTrue($rule->passes('cedule', 'V300000'));
        $this->assertTrue($rule->passes('cedule', 'V90000000'));
        $this->assertTrue($rule->passes('cedule', 'E300000'));
        $this->assertTrue($rule->passes('cedule', 'E90000000'));

        $this->assertFalse($rule->passes('cedule', 'V2'));
        $this->assertFalse($rule->passes('cedule', 'V299999'));
        $this->assertFalse($rule->passes('cedule', 'E299999'));
        $this->assertFalse($rule->passes('cedule', 'E90000001'));
        $this->assertFalse($rule->passes('cedule', 'V90000001'));

        $this->assertFalse($rule->passes('cedule', 'V10000000000001'));
        $this->assertFalse($rule->passes('cedule', ''));
        $this->assertFalse($rule->passes('cedule', 'FEsasgrrtrss'));

        $this->assertFalse($rule->passes('cedule', 'e13683474'));
        $this->assertFalse($rule->passes('cedule', 'v300000'));

        $this->assertFalse($rule->passes('cedule', '13683474'));

    }
}
