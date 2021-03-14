<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'admin_id' => 'A'.$faker->unique()->numberBetween(100,999),
        'password' => $faker->numberBetween(1234,12345),
        'email' => $faker->lastName.'@mail.com',
        'phone' => substr($faker->phoneNumber,0,12),
        'address' => $faker->city,
        'username' => $faker->unique()->firstName,
        'name' => $faker->name,
        'status'=> $faker->randomElement(['active', 'completed', 'on hold']),

    ];
});
