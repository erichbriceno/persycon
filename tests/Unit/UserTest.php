<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Model\{User, Login};
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function get_the_last_login_datetime_of_each_user()
    {
        $santiago = factory(User::class)->create(['names' => 'Santiago']);
        factory(Login::class)->create([
           'user_id' => $santiago->id,
            'created_at' => '2019-09-18 12:30:00',
        ]);

        factory(Login::class)->create([
            'user_id' => $santiago->id,
            'created_at' => '2019-09-18 12:31:00',
        ]);

        factory(Login::class)->create([
            'user_id' => $santiago->id,
            'created_at' => '2019-09-17 12:31:00',
        ]);

        $pedro = factory(User::class)->create(['names' => 'Pedro']);
        factory(Login::class)->create([
            'user_id' => $pedro->id,
            'created_at' => '2019-09-15 12:00:00',
        ]);

        factory(Login::class)->create([
            'user_id' => $pedro->id,
            'created_at' => '2019-09-15 12:01:00',
        ]);

        factory(Login::class)->create([
            'user_id' => $pedro->id,
            'created_at' => '2019-09-15 11:59:59',
        ]);

        $users = User::withLastLogin()->get();

        $this->assertEquals(Carbon::parse('2019-09-18 12:31:00'), $users->firstWhere('names', 'Santiago')->last_login_at);
        $this->assertEquals(Carbon::parse('2019-09-15 12:01:00'), $users->firstWhere('names', 'Pedro')->last_login_at);

    }
}
