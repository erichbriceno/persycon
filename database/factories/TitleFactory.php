<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model\{Title, Management, SalaryType};


$factory->define(Title::class, function (Faker $faker) {
    return [
        'name'          => $faker->name,
        'description'   => $faker->sentence(3),
        'category'      => rand(0,2)?'T1':'T2',
        'salary'        => 10.5,
        'management_id' => Management::Where('acronym', 'PE')->first()->id,
        'salary_type_id' => SalaryType::Where('name', 'Diario')->first()->id,
        'active'        => true,
    ];
});
