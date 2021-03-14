<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Teacher;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    $admin_ids = App\Admin::pluck('admin_id')->toArray();
    $university_ids = App\University::pluck('university_id')->toArray();
    return [
        'teacher_id' => 'T'.$faker->unique()->numberBetween(100,999),
        'password' => $faker->numberBetween(1234,12345),
        'email' => $faker->lastName.'@mail.com',
        'phone' => substr($faker->phoneNumber,0,12),
        'address' => $faker->city,
        'username' => $faker->unique()->firstName,
        'name' => $faker->name,
        'status'=> $faker->randomElement(['active', 'completed', 'on hold']),
        'salary' => $faker->numberBetween(20000,50000),
        'balance' => $faker->numberBetween(0,50000),
        'birthdate' => $faker->date(),
        'admin_id' => $faker->randomElement($admin_ids),
        'university_id' => $faker->randomElement($university_ids),
    ];
});
