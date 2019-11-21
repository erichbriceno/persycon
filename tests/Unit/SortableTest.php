<?php

namespace Tests\Feature\Unit;

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
    function builds_a_url_with_sortable_data()
    {
        $this->assertSame(
            'http://persycon.test/users?order=names',
            $this->sortable->url('names')
        );
    }

    /** @test */
    function appends_query_data_to_the_url()
    {
        $this->sortable->appends(['a' => 'parameter', 'and' => 'another-parameter']);

        $this->assertSame(
            'http://persycon.test/users?a=parameter&and=another-parameter&order=names',
            $this->sortable->url('names')
        );
    }

    /** @test */
    function builds_url_with_desc_order_if_the_current_column_matches_the_given_one_and_the_current_direction_is_asc()
    {
        $this->sortable->appends(['order' => 'names']);

        $this->assertSame(
            'http://persycon.test/users?order=names-desc',
            $this->sortable->url('names')
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
        $this->sortable->appends(['order' => 'names']);

        $this->assertSame('fa-caret-square-up', $this->sortable->classes('names'));
    }

    /** @test */
    function returns_a_css_class_to_indicate_the_column_is_sorted_in_descendent_order()
    {
        $this->sortable->appends(['order' => 'names-desc']);

        $this->assertSame('fa-caret-square-down', $this->sortable->classes('names'));
    }
}


