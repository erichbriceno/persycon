<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rules\Minimum1Valid;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryMinimumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function validates_category1_minimum_values()
    {
        $rule = new Minimum1Valid(9,10,19,20,29,30,39);

        $this->assertTrue($rule->passes('min1', '1'));
        $this->assertTrue($rule->passes('min1', '4'));
    }
}
