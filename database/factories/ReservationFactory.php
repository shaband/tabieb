<?php

use App\Models\Patient;
use App\Models\Schedule;

use Carbon\CarbonImmutable;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Reservation::class, function (Faker $faker) {


    $schedule = Schedule::inRandomOrder()->first();
    $date = CarbonImmutable::parse('2020-01-01')->addDays($faker->numberBetween(1, 365));
    $to_time = $faker->time($schedule->to_time);
    return [
        'doctor_id' => $schedule->doctor_id,
        'patient_id' => Patient::inRandomOrder()->first()->id,
        'schedule_id' => $schedule->id,
        'date' => $date,
        'from_time' => $faker->time($to_time),
        'to_time' => $to_time,
        'communication_type' => $faker->numberBetween(1, 3),
        'status_changed_at' => $date->addDays($faker->numberBetween(1, 30)),
        'status' => $faker->numberBetween(1, 5),
        'description' => $faker->sentence(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
