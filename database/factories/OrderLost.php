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

$factory->define(App\Models\OrderLost::class, function (Faker $faker) {
    return [

        'name' => $faker->name.' '.$faker->lastName,
        'email' => $faker->email,
        'data' => 'eyJpdiI6Ill3MXg1OW5zZ29RY1d6b2o0SFdFVHc9PSIsInZhbHVlIjoicXMwUys1TUN5OWNpZDk2UFdSUFp2TXBHSytMdVFDNFlcL0NhZGxsS0tuOURteE5Xem9qTnFGN0R0cWg4SnIwMk82d1lMZXJlZDRiTmM3d1pHMU54SXQzeGJjQnFzZVBWd2ZvMlpjbmhHZ1wvc2NDRUVTd1RqT3RZREhJR1d4aUh3cVRSclN1eVpxYW93TXA0N1dRRlpIeFYrXC9aNWpsdnZSVHJ0aHFhSHphbDEzdnJld3EzektSc25cLzgrenYyakhvdEJFMlNGWlRITlRWek50S0QxODJiRkE9PSIsIm1hYyI6ImNjZmQ5MzUyOTkzMGQ1MDNjOTE0ZDgwNzIyMGUxYzkwZDM3YmRiM2JmMWRmNTFhYmNmMjY5NmNhNmI3MGViN2MifQ==',
        'time_line' => $faker->url.'_'.$faker->url.'_'.$faker->url,
        'remember_token' => str_random(10),
        'course_id' => 1

    ];
});
