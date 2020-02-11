<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Doctor::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'first_name_en' => $faker->text(63),
        'last_name_en' => $faker->text(63),
        'last_name_ar' => $faker->text(63),
        'first_name_ar' => $faker->text(63),

        'title_ar' => $faker->text(63),
        'title_en' => $faker->text(63),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$uTDnsRa0h7wLppc8/vB9C.YqsrAZwhjCgLWjcmpbndTmyo1k5tbRC',
        'phone' => $faker->phoneNumber,
        'price' => $faker->numberBetween(1, 100),
        //  'last_login' => $faker->dateTime,
        // 'email_verified_at' => $faker->dateTime,
        // 'phone_verified_at' => $faker->dateTime,
        'civil_id' => $faker->numerify(),
        'gender' => $faker->numberBetween(1, 2),
    ];
});
