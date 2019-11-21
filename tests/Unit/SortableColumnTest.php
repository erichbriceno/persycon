<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Rules\SortableColumn;

class SortableColumnTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function validates_sortable_values()
    {
        $rule = new SortableColumn(['names', 'email']);

        $this->assertTrue($rule->passes('order', 'names'));
        $this->assertTrue($rule->passes('order', 'email'));
        $this->assertTrue($rule->passes('order', 'names-desc'));
        $this->assertTrue($rule->passes('order', 'email-desc'));

        $this->assertFalse($rule->passes('order', []));
        $this->assertFalse($rule->passes('order', 'names-descendent'));
        $this->assertFalse($rule->passes('order', 'asc-name'));
        $this->assertFalse($rule->passes('order', 'email-'));
        $this->assertFalse($rule->passes('order', 'email-des'));
        $this->assertFalse($rule->passes('order', 'names-descx'));
        $this->assertFalse($rule->passes('order', 'desc-names'));
    }

}
