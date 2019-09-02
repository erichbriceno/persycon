<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->sentence(3),
    ];
});
