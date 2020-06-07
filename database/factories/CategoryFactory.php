<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model\{ Category, Project};

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => "T". rand(5,9),
        'description' => $faker->sentence(3),
    ];
});
