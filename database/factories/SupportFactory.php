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

$factory->define(App\Models\Support::class, function (Faker $faker) {
    //Usuarios fro, to
    $user =  $faker->randomElement([1,17]);
    $from = 0;
    $to = 0;
    //cargamos usuarios from  y to
    $from = $user;
    $from == 1 ? $to = 17 : $to = 1;

    return [
        'from_id' => $from,
        'to_id' => $to,
        'subject' => $faker->text($maxNbChars = 25),
        'text' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'state' => $faker->randomElement([1,0]),
    ];
});
