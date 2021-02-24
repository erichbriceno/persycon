<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->truncateTables([
            'titles',
            'category_project',
            'salary_types',
            'categories',
            'coordinations',
            'saime_datos_ac',
            'managements',
            'projects',
            'groups',
            'roles',
            'users',
            'people',

        ]);

        $this->call([
            CategorySeeder::class,
            RoleSeeder::class,
            SalaryTypesSeeder::class,
            CedulateSeeder::class,
            ProjectSeeder::class,
            ManagementSeeder::class,
            CoordinationSeeder::class,
            TitleSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            PeopleSeeder::class,
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
