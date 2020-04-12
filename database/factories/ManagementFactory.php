<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Management;
use Faker\Generator as Faker;

$factory->define(Management::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->word(3),
    ];
});
