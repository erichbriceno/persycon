<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Cedulate;
use Faker\Generator as Faker;

$factory->define(Cedulate::class, function (Faker $faker) {
    return [
        'idpersona' => $faker->unique()->md5,
        'letra' =>  rand(0,10)?'V':'E',
        'numerocedula' => $faker->numberBetween(500000,37000000),
        'primernombre' => $faker->firstName,
        'segundonombre' => $faker->firstName,
        'primerapellido' => $faker->lastName,
        'segundoapellido' => $faker->lastName,
        'fechanacimiento' => $faker->date('Y-m-d', 'now'),
        'sexo' =>   rand(0,2)?'m':'f',
    ];
});
