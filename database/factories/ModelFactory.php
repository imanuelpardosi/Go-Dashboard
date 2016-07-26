<?php

/*
|--------------------------------------------------------------------------
| Models Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Models factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'occupation' => $faker->jobTitle,
        'password' => 'go12345'
    ];
});
