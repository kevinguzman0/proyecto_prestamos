<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Perfiles;
use App\str_random;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Perfiles::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
        'password' => bcrypt('12345678'),
        'remember_token' => null,
    ];
});
