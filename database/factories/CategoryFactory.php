<?php

use App\Models\Category;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        // 'category_id' => Category::inRandomOrder()->first()->id,
        'name_ar' => $faker->name(),
        'name_en' => $faker->name(),
        'description_ar' => $faker->text(12),
        'description_en' => $faker->text(12),
        'category_id' => optional(Category::where('category_id', null)->where('blocked_at', null)->inRandomOrder()->first())->id,
        //  'blocked_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
