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
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Coordinador de logística',
            'description'   => 'Coordinador de la actividades de logísticas',
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Supervisor de líneas',
            'description'   => 'Supervisor de líneas de producción',
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Administrativo',
            'description'   => 'Analista administrativo',
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);

        factory(Title::class)->create([
            'name'          => 'Operador',
            'description'   => 'Operador de lineas',
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);
        
        factory(Title::class)->create([
            'name'          => 'Apoyo',
            'description'   => 'Apoyo logístico',
            'management_id' => $this->managements->where('acronym', 'PE')->first()->id,
            'salary_type_id'=> $this->salaryTypes->first()->id,
        ]);
    }


    protected function fetchRelations()
    {
        $this->managements = Management::where('active', true)->get();
        $this->salaryTypes = SalaryType::all();
    }

}