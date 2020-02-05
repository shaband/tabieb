<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorCategoryTable extends Migration {

	public function up()
	{
		Schema::create('doctor_category', function(Blueprint $table) {
			$table->bigInteger('category_id')->unsigned();
			$table->bigInteger('doctor_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('doctor_category');
	}
}