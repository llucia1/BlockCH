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

$factory->define(App\Models\Video::class, function (Faker $faker) {
    return [

        'video_category_id' => $faker->numberBetween($min = 1, $max = 5),
        'name' => $faker->text($maxNbChars = 75),
        'category_name' => $faker->randomElement(['Blockchain', 'Minería', 'Red P2P']),
        'code' => $faker->randomElement(['6k_nsEPhAo', 'bwVPQB2t-8g', 'Vg5sfCX8B8I']),
    ];
});

