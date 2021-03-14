<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    $admin_ids = App\Admin::pluck('admin_id')->toArray();
    $university_ids = App\University::pluck('university_id')->toArray();
    return [
        'department_id' => 'D'.$faker->unique()->numberBetween(100,999),
        'name' => $faker->firstName,
        'admin_id' => $faker->randomElement($admin_ids),
        'university_id' => $faker->randomElement($university_ids),
    ];
});
