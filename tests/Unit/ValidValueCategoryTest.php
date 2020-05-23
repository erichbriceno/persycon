<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rules\ValidValueCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidValueCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function validates_category1_minimum_values()
    {
        $rule = new ValidValueCategory(2,9,20,39,40,59,60,79);

        $this->assertTrue ($rule->passes('min1', '1'));
        $this->assertFalse($rule->passes('min1', '9'));
        
        $this->assertTrue ($rule->passes('max1', '8'));
        $this->assertFalse($rule->passes('max1', '0'));
        
        $this->assertTrue ($rule->passes('min2', '11'));
        $this->assertTrue($rule->passes('min2', '29'));
    }
}
