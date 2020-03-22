<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_create_projects_page()
    {
        $this->get(route('project.create'))
            ->assertStatus(200)
            ->assertViewIs('project.create')
            ->assertSee(trans('titles.project.create'));
    }
}
