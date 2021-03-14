<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\University;
use Faker\Generator as Faker;

$factory->define(University::class, function (Faker $faker) {
    $admin_ids = App\Admin::pluck('admin_id')->toArray();
    return [
        'university_id' => 'U'.$faker->unique()->numberBetween(100,999),
        'name' => $faker->firstName,
        'address' => $faker->city,
        'admin_id' => $faker->randomElement($admin_ids),
    ];
});
