<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => "{$faker->firstName} {$faker->numberBetween(2018,2020)}" ,
        'description' => $faker->sentence(3),
        'start' => today(),
        'active' => rand(0,3)?1:0,
    ];
});
