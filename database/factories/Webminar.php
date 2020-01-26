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

$factory->define(App\Models\Webminar::class, function (Faker $faker) {
	//fechas random
	$start = $faker->randomElement(['27/12/2019', '01/02/2019', '30/07/2019']);
	$start_date = str_replace('/','',$start);
    return [

        'name' => $faker->text($maxNbChars = 50),
        'text' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'url' => $faker->url,
        'start' => $start,
        'start_date' => $start_date,
        'start_hour' => date('Hi'),

    ];
});
