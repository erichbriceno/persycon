<?php

use Illuminate\Database\Seeder;
use App\Model\{Title, Management, SalaryType};

class TitleSeeder extends Seeder
{
    protected $managements;
    protected $salaryTypes;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fetchRelations();

        factory(Title::class)->create([
            'name'          => 'Coordinador de producción',
            'description'   => 'Coordinador de la actividades de producción',
            'category'      => 'T1',
            'salary'        => 81.5,
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Coordinador de logística',
            'description'   => 'Coordinador de la actividades de logísticas',
            'category'      => 'T1',
            'salary'        => 80.3,
            'management_id' => $this->managements->where('acronym', 'CNS')->first()->id,
            'salary_type_id'=> $this->salaryTypes->where('name', 'Semanal')->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Supervisor de líneas',
            'description'   => 'Supervisor de líneas de producción',
            'category'      => 'T3',
            'salary'        => 54.5,
            'management_id' => $this->managements->where('acronym', 'ODC')->first()->id,
            'salary_type_id'=> $this->salaryTypes->where('name', 'Semanal')->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Administrativo',
            'description'   => 'Analista administrativo',
            'category'      => 'T2',
            'salary'        => 67.1,
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->where('name', 'Mensual')->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Operador',
            'description'   => 'Operador de lineas',
            'category'      => 'T1',
            'salary'        => 30.0,
            'management_id' => $this->managements->where('acronym', 'CNS')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);
        
        factory(Title::class)->create([
            'name'          => 'Apoyo',
            'description'   => 'Apoyo logístico',
            'category'      => 'T1',
            'salary'        => 30.0,
            'management_id' => $this->managements->where('acronym', 'ODC')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);
    }


    protected function fetchRelations()
    {
        $this->managements = Management::where('active', true)->get();
        $this->salaryTypes = SalaryType::all();
    }

}