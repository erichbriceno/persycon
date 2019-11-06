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
            'description' => 'Master',
            'selectable' => false
        ]);

        factory(Role::class)->create([
            'description' => 'Administrator',
        ]);

        factory(Role::class)->create([
            'description' => 'User',
        ]);

        //factory(Role::class)->times(2)->create();
    }
}
