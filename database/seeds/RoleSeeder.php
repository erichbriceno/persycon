<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create([
            'description' => 'master',
        ]);

        factory(Role::class)->create([
            'description' => 'admim',
        ]);

        factory(Role::class)->create([
            'description' => 'user',
        ]);

        factory(Role::class)->times(2)->create();
    }
}
