<?php

namespace Tests\Feature\Admin;

use App\Model\{User, Role};
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

        /** @test */
    function it_authorizer_admin_can_see_the_menu()
    {
        $user = factory(User::class)->create([
            'role_id' => Role::Where('name', 'Master')->first()->id,
        ]);

        $this->actingAs($user);

        $this->get(route('home'))
            ->assertSee('Administración')
            ->assertSee('Personal')
            ->assertSee('Nómina')
            ->assertStatus(200);
    }

    /** @test */
    function when_an_administrator_goes_to_the_project_link_he_can_see_them()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->get(route('projects'))
            ->assertStatus(200);
            //->assertSee(trans('titles.title.project'));
    }


}
