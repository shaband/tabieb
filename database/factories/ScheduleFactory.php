<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Schedule::class, function (Faker $faker) {
    return [
        'doctor_id' => \App\Models\Doctor::inRandomOrder()->first()->id,
        'day' => $faker->numberBetween(1, 7),
        'from_time' => \Carbon\Carbon::now()->subHour($faker->numberBetween(1, 23)),
        'to_time' => \Carbon\Carbon::now()->subHour($faker->numberBetween(1, 23))
    ];
});
