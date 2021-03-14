<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $admin_ids = App\Admin::pluck('admin_id')->toArray();
    $university_ids = App\University::pluck('university_id')->toArray();
    $department_ids = App\Department::pluck('department_id')->toArray();
    return [
        'student_id' => 'S'.$faker->unique()->numberBetween(1000,9999),
        'password' => $faker->numberBetween(1234,12345),
        'email' => $faker->lastName.'@mail.com',
        'phone' => substr($faker->phoneNumber,0,12),
        'address' => $faker->city,
        'username' => $faker->unique()->firstName,
        'name' => $faker->name,
        'status'=> $faker->randomElement(['active', 'completed', 'on hold']),
        'balance' => $faker->numberBetween(0,50000),
        'credits_completed' => $faker->numberBetween(0,60),
        'CGPA' => 0,
        'admission_date' => $faker->date(),
        'birthdate' => $faker->date(),
        'admin_id' => $faker->randomElement($admin_ids),
        'university_id' => $faker->randomElement($university_ids),
        'department_id' => $faker->randomElement($department_ids),
    ];
});
