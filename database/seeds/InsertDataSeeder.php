<?php

use Illuminate\Database\Seeder;

class InsertDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\SocialSecurity::class,10)->create();
        factory(\App\Models\Category::class,10)->create();
        factory(\App\Models\Doctor::class,300)->create();
        factory(\App\Models\Schedule::class,600)->create();
        factory(\App\Models\Reservation::class,400)->create();
        factory(\App\Models\Rating::class,400)->create();
        factory(\App\Models\PatientQuestion::class,20)->create();
        factory(\App\Models\PatientAnswer::class,60)->create();
    }
}
