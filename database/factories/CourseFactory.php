<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $admin_ids = App\Admin::pluck('admin_id')->toArray();
    $department_ids = App\Department::pluck('department_id')->toArray();
    $subject_codes = App\Subject::pluck('subject_code')->toArray();
    return [
        'course_id' => 'CI'.$faker->unique()->numberBetween(100,999),
        'name' => $faker->firstName,
        'credits' => $faker->numberBetween(1,3),
        'semester' => $faker->numberBetween(2000,2021).$faker->randomElement([' Spring',' Summer',' Fall']),
        'admin_id' => $faker->randomElement($admin_ids),
        'subject_code' => $faker->randomElement($subject_codes),
        'prerequisite' => $faker->randomElement($subject_codes),
        'department_id' => $faker->randomElement($department_ids),
    ];
});
