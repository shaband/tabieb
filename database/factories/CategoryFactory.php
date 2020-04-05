<?php

use App\Models\Category;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
       // 'category_id' => Category::inRandomOrder()->first()->id,
        'name_ar' => $faker->text(63),
        'name_en' => $faker->text(63),
        'description_ar' => $faker->text(16383),
        'description_en' => $faker->text(16383),
        'blocked_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
