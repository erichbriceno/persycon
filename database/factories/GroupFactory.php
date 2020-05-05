<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model\{ Group, Coordination};

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->sentence(3),
        'coordination_id' => Coordination::all()->random()->id,

    ];
});
