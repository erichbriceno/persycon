<?php

namespace Tests\Feature\Project;

use App\Model\{User, Role};
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function when_an_administrator_goes_to_the_project_link_he_can_see_them()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->get(route('projects'))
            ->assertStatus(200)
            ->assertSee(trans('projects.emptyMessage.index'));
    }


}
