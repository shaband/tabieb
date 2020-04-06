<?php

use App\Models\Category;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Doctor::class, function (Faker $faker) {
    return [
        'category_id' => Category::inRandomOrder()->first()->id,
        'first_name_en' => $faker->firstName(),
        'last_name_en' => $faker->lastName,
        'last_name_ar' => $faker->lastName,
        'first_name_ar' => $faker->firstName(),
        'description_ar' => $faker->text(12),
        'description_en' => $faker->text(12),
        'title_ar' => $faker->jobTitle,
        'title_en' => $faker->jobTitle,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$uTDnsRa0h7wLppc8/vB9C.YqsrAZwhjCgLWjcmpbndTmyo1k5tbRC',
        'phone' => $faker->phoneNumber,
        'price' => $faker->numberBetween(10,500),
        'period' => $faker->numberBetween(15,60),
     //   'last_login' => $faker->dateTime,
        'email_verified_at' => $faker->dateTime,
        'phone_verified_at' => $faker->dateTime,
        'civil_id' => rand(0000000000, 9999999999),
        'enable_active' => $faker->boolean(),
        'verification_code' => rand(00000, 99999),
        'remember_token' => $faker->sha1,
        'gender' => $faker->boolean(50),
        //'blocked_at' => $faker->dateTime,
       // 'blocked_reason' => $faker->text(0),
       // 'created_at' => $faker->dateTime,
       // 'updated_at' => $faker->dateTime,
    ];
});
