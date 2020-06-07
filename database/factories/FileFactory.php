<?php

/** @var Factory $factory */

    use App\File;
    use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;
    use Illuminate\Support\Str;

    $factory->define(File::class, function (Faker $faker) {
        $gender = $faker->randomElement(['male', 'female']);
        return [

            'name' => $faker->firstName($gender),
            'number' => Str::fileNumber(),
            'slug' => $faker->slug(10),
            'surname' => $faker->lastName,
            'contact' => $faker->unique()->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'dob' => date($faker->dateTimeBetween('1940-01-01', '2000-12-31')
                ->format('Y-m-d')),
            'gender' => $gender,
            'postal_address' => $faker->address,
            'physical_address' => $faker->city,
        ];
});
