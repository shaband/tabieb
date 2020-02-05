<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('patient_questions', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar')->nullable();
			$table->string('name_en')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('patient_questions');
	}
}