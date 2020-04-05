<?php

use App\Models\Doctor;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Schedule::class, function (Faker $faker) {
   $to_time=$faker->time();
    return [
        'doctor_id' => Doctor::inRandomOrder()->first()->id,
        'day' => $faker->numberBetween(1,7),
        'from_time'=>$faker->time($to_time),
         'to_time'=>$to_time,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
