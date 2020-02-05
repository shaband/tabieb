<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone' => $faker->phoneNumber,
        //'blocked_at' => $faker->dateTime,
       // 'blocked_reason' => $faker->text(4194303),
        'remember_token' => $faker->sha1,
       // 'created_at' => $faker->dateTime,
       // 'updated_at' => $faker->dateTime,
    ];
});
