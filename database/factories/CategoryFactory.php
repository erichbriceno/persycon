<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model\{ Category, Project};

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => "T". rand(5,9),
        'minimum' => $faker->numberBetween(10,35),
        'maximum' => $faker->numberBetween(45,75),
        'project_id' => Project::first()->id, 
    ];
});
