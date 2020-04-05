<?php

use App\Models\SocialSecurity;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Patient::class, function (Faker $faker) {
    return [
        'social_security_id' => SocialSecurity::inRandomOrder()->first()->id,
        //'district_id' => $faker->numberBetween(0, 4294967295),
        //'area_id' => $faker->numberBetween(0, 4294967295),
        //'block_id' => $faker->numberBetween(0, 4294967295),
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'password' => '$2y$10$uTDnsRa0h7wLppc8/vB9C.YqsrAZwhjCgLWjcmpbndTmyo1k5tbRC',
        'civil_id' => $faker->numberBetween(0, 4294967295),
   //     'blocked_at' => $faker->dateTime,
  //      'blocked_reason' => $faker->text(),
        'birthdate' => $faker->dateTime,
        'social_security_expired_at' => $faker->dateTime,
        'remember_token' => $faker->sha1,
        'email_verified_at' => $faker->dateTime,
        'phone_verified_at' => $faker->dateTime,
   //     'verification_code' => $faker->text(63),
        'last_login' => $faker->dateTime,
        'gender' => $faker->numberBetween(1,2),
        'fb_token' => $faker->sha1,
        'google_token' => $faker->sha1,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
