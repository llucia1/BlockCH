<?php

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

$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [
        'name' => $faker->text($maxNbChars = 25),
        'amount' => $faker->numberBetween($min = 50, $max = 500),
        'short_description' => $faker->text($maxNbChars = 25),
    ];
});

