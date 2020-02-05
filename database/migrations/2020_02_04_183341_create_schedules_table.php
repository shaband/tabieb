<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchedulesTable extends Migration {

	public function up()
	{
		Schema::create('schedules', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('doctor_id')->unsigned()->index();
			$table->tinyInteger('day')->unsigned()->nullable();
			$table->time('from_time')->nullable();
			$table->time('to_time')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('schedules');
	}
}