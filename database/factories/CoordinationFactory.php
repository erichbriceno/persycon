<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model\{Coordination, Management};

$factory->define(Coordination::class, function (Faker $faker) {
    return [
        'name' => "{$faker->firstName} {$faker->firstName}" ,
        'description' => $faker->sentence(3),
        'management_id' => Management::Where('active', true)->get()->random()->id,
        'active' => true,
    ];
});
