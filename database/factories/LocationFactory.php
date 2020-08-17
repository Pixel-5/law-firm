<?php

/** @var Factory $factory */

use App\Venue;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'location'=>$faker->city
    ];
});
