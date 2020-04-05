<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\SocialSecurity::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'name_ar' => $faker->text(63),
        'name_en' => $faker->text(63),
    ];
});
