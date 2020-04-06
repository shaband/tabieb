<?php

use App\Models\Patient;
use App\Models\PatientAnswer;
use App\Models\PatientQuestion;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\PatientAnswer::class, function (Faker $faker) {

$patient_id=Patient::inRandomOrder()->first()->id;
$have_questions=PatientAnswer::where('patient_id',$patient_id)->pluck('question_id');


    return [
        'patient_id' =>$patient_id,
        'question_id' => PatientQuestion::whereNotIn('id',$have_questions)->inRandomOrder()->first()->id,
        'answer' => $faker->sentence(),
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
