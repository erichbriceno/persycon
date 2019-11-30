<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->truncateTables([
            'managements',
            'projects',
            'saimes',
            'groups',
            'roles',
            'users',
        ]);

        $this->call([
            ManagementSeeder::class,
            ProjectSeeder::class,
            SaimeSeeder::class,
            GroupSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
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
