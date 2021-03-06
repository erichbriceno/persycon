<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\{User, Role};
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'nat' =>  rand(0,10)?'V':'E',
        'numberced' => $faker->unique()->numberBetween(500000,37000000),
        'names' => $faker->name,
        'surnames' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'role_id' => Role::Where('name', 'User')->first()->id,
        'management_id' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'active' => '1',
        'remember_token' => Str::random(10),
    ];
});
