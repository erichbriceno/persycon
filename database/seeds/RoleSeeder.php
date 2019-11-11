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
            'name' => 'Master',
            'description' => 'All permissions activated',
            'selectable' => false
        ]);

        factory(Role::class)->create([
            'name' => 'Administrator',
            'description' => 'All active management permissions',
        ]);

        factory(Role::class)->create([
            'name' => 'User',
            'description' => 'Only user permissions',
        ]);

        //factory(Role::class)->times(2)->create();
    }
}
