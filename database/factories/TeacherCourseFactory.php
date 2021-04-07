<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TeacherCourse;
use Faker\Generator as Faker;

$factory->define(TeacherCourse::class, function (Faker $faker) {
    $teacher_ids = App\Teacher::pluck('teacher_id')->toArray();
    $course_ids = App\Course::pluck('course_id')->toArray();
    

    return [
        'teacher_course_id' => 'TC'.$faker->unique()->numberBetween(100,999),
        'teacher_id' =>   $faker->randomElement($teacher_ids),
        'course_id' => $faker->randomElement($course_ids),
        'status'=> $faker->randomElement(['active', 'completed']),
    ];
});
