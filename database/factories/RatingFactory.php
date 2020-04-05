<?php

use App\Models\Reservation;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Rating::class, function (Faker $faker) {

$reservation=    Reservation::whereDoesntHave('rating')->inRandomOrder()->first();
    return [
        'reservation_id' => $reservation->id,
        'doctor_id' => $reservation->doctor_id,
        'patient_id' => $reservation->patient_id,
        'rate' => $faker->numberBetween(1,5),
        'description' => $faker->text(16383),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
