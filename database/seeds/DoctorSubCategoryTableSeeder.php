<?php

use App\Models\Category;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Faker\Generator ;

class DoctorSubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('doctor_category')->delete();
        $Doctors = Doctor::with('category')->get()->each(function ($doctor) {
            $category = $doctor->category;
            if ($category->sub_categories->count()) {
                $sub_categories = $category->sub_categories->pluck('id');
            } else {
                $faker = Faker\Factory::create();
                $sub_category = Category::create([
                    'category_id' => $category->id,
                    'name_ar' => $faker->name,
                    'name_en' => $faker->name,
                    'description_ar' => $faker->sentence(),
                    'description_en' => $faker->sentence(),
                ]);
                $sub_categories = [$sub_category->id];
            }
            $doctor->sub_categories()->attach($sub_categories);
        });
    }
}
