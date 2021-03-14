<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    $admin_ids = App\Admin::pluck('admin_id')->toArray();
    $university_ids = App\University::pluck('university_id')->toArray();
    $department_ids = App\Department::pluck('department_id')->toArray();
    return [
        'subject_code' => 'SB'.$faker->unique()->numberBetween(100,999),
        'name' => $faker->firstName,
        'admin_id' => $faker->randomElement($admin_ids),
        'university_id' => $faker->randomElement($university_ids),
        'department_id' => $faker->randomElement($department_ids),
    ];
});
