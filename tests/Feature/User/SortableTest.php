<?php

namespace Tests\Feature\User;

use App\Sortable;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class SortableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Sortable
     */
    protected $sortable;

    public function setUp(): void
    {
        parent::setUp();

        $this->sortable = new Sortable('http://persycon.test/users');
    }

    /** @test */
    function builds_url_with_sortable_data()
    {

        $this->assertSame(
            'http://persycon.test/users?order=names&direction=asc',
            $this->sortable->url('names')
        );
    }

    /** @test */
    function builds_url_with_desc_order_if_the_current_column_matches_the_given_one_and_the_current_direction_is_asc()
    {
        $this->sortable->setCurrentOrder('names', 'asc');

        $this->assertSame(
            'http://persycon.test/users?order=names&direction=desc',
            $this->sortable->url('names', 'desc')
        );
    }


    /** @test */
    function returns_a_css_class_to_indicate_the_column_is_sortable()
    {

        $this->assertSame('fa-sort', $this->sortable->classes('name'));
    }

    /** @test */
    function returns_a_css_class_to_indicate_the_column_is_sorted_in_ascendent_order()
    {
        $this->sortable->setCurrentOrder('names');

        $this->assertSame('fa-caret-square-up', $this->sortable->classes('names'));
    }

    /** @test */
    function returns_a_css_class_to_indicate_the_column_is_sorted_in_descendent_order()
    {
        $this->sortable->setCurrentOrder('name', 'desc');

        $this->assertSame('fa-caret-square-down', $this->sortable->classes('name'));
    }
}


