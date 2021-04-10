<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StudentCourse;
use Faker\Generator as Faker;

$factory->define(StudentCourse::class, function (Faker $faker) {
    $student_id = App\Student::pluck('student_id')->toArray();
    $course_ids = App\Course::pluck('course_id')->toArray();

    return [
        'student_course_id' => 'SC'.$faker->unique()->numberBetween(100,999),
        'marks' => 0,
        'status'=> $faker->randomElement(['active', 'completed','dropped','pending','dropping']),
        'student_id' =>   $faker->randomElement($student_id),
        'course_id' => $faker->randomElement($course_ids),
    ];
});
