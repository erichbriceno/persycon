<?php


use App\Model\SalaryType;
use Illuminate\Database\Seeder;

class SalaryTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SalaryType::class)->create([
            'name' => 'Diario',
            'description' => 'Salario diario',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Semanal',
            'description' => 'Salario semanal',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Mensual',
            'description' => 'Salario mensual',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Mixto',
            'description' => 'Salario mixto',
        ]);

        factory(SalaryType::class)->create([
            'name' => 'Único',
            'description' => 'Compensación única',
        ]);


    }
}
