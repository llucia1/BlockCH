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

$factory->define(App\Models\CreditsCollection::class, function (Faker $faker) {
    $concept = $faker->randomElement(['Referenciado', 'Curso']);
    $credits = $faker->randomElement([20, 10]);
    return [

        'user_id' => 17,
        'row_id' => 2,
        'full_name' => $faker->name,
        'concept' => $concept,
        'credits' => $credits,
    ];
});

