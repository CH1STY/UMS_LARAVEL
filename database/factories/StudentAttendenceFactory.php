<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StudentAttendence;
use Faker\Generator as Faker;

$factory->define(StudentAttendence::class, function (Faker $faker) {

    $teacher_id = App\TeacherCourse::pluck('teacher_id')->toArray();
    $course_id = App\TeacherCourse::pluck('course_id')->toArray();
    $student_id = App\Student::pluck('student_id')->toArray();
    return [
        'student_attendence_id' => 'SA'.$faker->unique()->numberBetween(1000,9999),
        'attendence' => $faker->numberBetween(6,10),
        'status'=> $faker->randomElement(['active', 'completed']),
        'student_id' =>   $faker->randomElement($student_id),
        'course_id' =>   $faker->randomElement($course_id),
        'teacher_id' =>   $faker->randomElement($teacher_id),

    ];
});
