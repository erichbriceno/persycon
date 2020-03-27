<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rules\CeduleExist;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CeduleExistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function validates_cedules_exist()
    {
        $rule = new CeduleExist();

        $this->assertTrue($rule->passes('cedule', 'V13683474'));
        $this->assertTrue($rule->passes('cedule', 'V16638929'));
        $this->assertTrue($rule->passes('cedule', 'V16638933'));

        $this->assertFalse($rule->passes('cedule', 'E13683474'));
        $this->assertFalse($rule->passes('cedule', 'E16638929'));
        $this->assertFalse($rule->passes('cedule', 'V16638934'));

    }
}
