<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'bio' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'type' => $faker->randomElement($array = array ('Admin','Standar User','Author')),
        'password' => '$2y$10$XRTIpntDJqJwS7Qzc048.OGHwslY0vCu74KrO2m4tUSQfU/2sELFW', // secret
        'email_verified_at' => now(),
        'remember_token' => str_random(10),
    ];
});
