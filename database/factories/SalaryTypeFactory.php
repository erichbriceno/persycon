<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\SalaryType;
use Faker\Generator as Faker;

$factory->define(SalaryType::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->sentence(3),
    ];
});
