<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Management;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Management::class, function (Faker $faker) {
    return [
        'acronym'       => Str::upper($faker->unique()->word(1)),
        'name'          => $faker->name,
        'description'   => $faker->sentence(1),
    ];
});
