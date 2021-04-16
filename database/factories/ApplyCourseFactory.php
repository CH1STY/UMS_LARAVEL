<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ApplyCourse;
use Faker\Generator as Faker;

$factory->define(ApplyCourse::class, function (Faker $faker) {
    $student_ids = App\Student::pluck('student_id')->toArray();
    $course1_ids = App\Course::pluck('course_id')->toArray();
    $course2_ids = App\Course::pluck('course_id')->toArray();
    $course3_ids = App\Course::pluck('course_id')->toArray();
    $course4_ids = App\Course::pluck('course_id')->toArray();
    return [
        'apply_course_id' => 'S'.$faker->unique()->numberBetween(1000,9999),
        'course1_id' => $faker->randomElement($course1_ids),
        'course2_id' => $faker->randomElement($course2_ids),
        'course3_id' => $faker->randomElement($course1_ids),
        'course4_id' => $faker->randomElement($course2_ids),
        'status'=> $faker->randomElement(['applied', 'approved', 'canceld']),
        'student_id' => $faker->randomElement($student_ids),
    ];
});
