<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\SocialSecurity::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'name_ar' => $faker->name(),
        'name_en' => $faker->name(),
    ];
});
