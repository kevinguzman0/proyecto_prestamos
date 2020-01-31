<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\str_random;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'),
        'remember_token' => str_random(10),
    ];
});
