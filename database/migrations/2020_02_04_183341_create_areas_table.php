<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasTable extends Migration {

	public function up()
	{
		Schema::create('areas', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar');
			$table->string('name_en');
			$table->bigInteger('district_id')->unsigned()->index();
			$table->timestamp('blocked_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('areas');
	}
}