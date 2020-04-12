<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Coordination;
use Faker\Generator as Faker;

$factory->define(Coordination::class, function (Faker $faker) {
    return [
        'name' => "{$faker->firstName} {$faker->firstName}" ,
        'description' => $faker->sentence(3),
        'active' => true,
    ];
});
