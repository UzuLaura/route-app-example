<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'address' => $faker->address,
        'distance' => $faker->numberBetween(1, 500)
    ];
});
