<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar')->nullable();
			$table->string('name_en')->nullable();
			$table->longText('answer_ar')->nullable();
			$table->longText('answer_en');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}
}