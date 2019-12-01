<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->truncateTables([
            'saime_datos_ac',
            'managements',
            'projects',
            'groups',
            'roles',
            'users',
        ]);

        $this->call([
            ManagementSeeder::class,
            CedulateSeeder::class,
            ProjectSeeder::class,
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
