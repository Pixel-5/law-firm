<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

    use App\Role;
    use Faker\Generator as Faker;
use App\Model;

$factory->define(Role::class, function (Faker $faker) {
    $roles = [
        [
            'id'    => 1,
            'title' => 'Admin',
        ],
        [
            'id'    => 2,
            'title' => 'Lawyer',
        ],
        [
            'id'    => 3,
            'title' => 'Super',
        ],
    ];
    $role  = $faker->randomElement($roles);
    return [
        'id' =>$role['id'],
        'title'=>$role['title'],
    ];
});
