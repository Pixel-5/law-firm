<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use App\Profile;
    use Illuminate\Database\Eloquent\Factory;

    $factory->define(Profile::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
    ];
});
