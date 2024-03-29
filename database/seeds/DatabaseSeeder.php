<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //   $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(HomePageSettingsSeeder::class);
        $this->call(InsertDataSeeder::class);

        // $this->call(SocialSecuritiesTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        //  $this->call(DoctorsTableSeeder::class);
        //  $this->call(PatientsTableSeeder::class);
        //  $this->call(SchedulesTableSeeder::class);
        //  $this->call(ReservationsTableSeeder::class);
        //  $this->call(RatingsTableSeeder::class);
        //  $this->call(PatientQuestionsTableSeeder::class);
        //  $this->call(PatientAnswersTableSeeder::class);
        //  $this->call(DoctorCategoryTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
