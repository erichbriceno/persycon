<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\People;
use Faker\Generator as Faker;

$factory->define(People::class, function (Faker $faker) {
    return [
        'nat' =>  rand(0,10)?'V':'E',
        'numberced' => $faker->unique()->numberBetween(500000,37000000),
        'names' => $faker->name,
        'surnames' => $faker->lastName,
        'birthday' => $faker->date('Y-m-d', 'now'),
        'gender' =>   rand(0,2)?'m':'f',
        'email' => $faker->unique()->safeEmail,
        'active' => '1',
    ];
});
