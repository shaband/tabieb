<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\PatientQuestion::class, function (Faker $faker) {
    return [
        'name_ar' => $faker->text(63),
        'name_en' => $faker->text(63),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
