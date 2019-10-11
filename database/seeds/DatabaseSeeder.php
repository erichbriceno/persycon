<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->truncateTables([
            'managements',
            'groups',
            'projects',
            'users',
            'roles'
        ]);

        $this->call([
            ProjectSeeder::class,
            ManagementSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            RoleSeeder::class
        ]);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
