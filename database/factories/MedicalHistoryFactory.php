<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\MedicalHistory::class, function (Faker $faker) {

    $reservation = \App\Models\Reservation::where('status', \App\Models\Reservation::STATUS_FINISHED)->inRandomOrder()->first();
    return [
        'patient_id' => $reservation->patient_id,
        'reservation_id' => $reservation->id,
        // 'category_id' => $faker->numberBetween(0, 4294967295),
        'creator_type' => 'doctors',
        'creator_id' => $reservation->doctor_id,
        'title' => $faker->title,
        'date' => \Carbon\Carbon::now()->subDays($faker->numberBetween(1, 90)),
        'description' => $faker->sentence,
        // 'created_at' => $faker->dateTime,
        // 'updated_at' => $faker->dateTime,
    ];
});
