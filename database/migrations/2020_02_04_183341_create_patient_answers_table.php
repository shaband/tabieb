<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientAnswersTable extends Migration {

	public function up()
	{
		Schema::create('patient_answers', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('patient_id')->unsigned()->index();
			$table->bigInteger('question_id')->unsigned()->index();
			$table->text('answer')->nullable();
			$table->boolean('status')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('patient_answers');
	}
}