<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

	public function up()
	{
		Schema::create('ratings', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->tinyInteger('rate')->unsigned()->index()->default('0');
			$table->bigInteger('reservation_id')->unsigned()->index();
			$table->bigInteger('doctor_id')->unsigned()->nullable()->index();
			$table->bigInteger('patient_id')->unsigned()->index();
			$table->text('description');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ratings');
	}
}