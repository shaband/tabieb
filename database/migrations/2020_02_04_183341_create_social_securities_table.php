<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialSecuritiesTable extends Migration {

	public function up()
	{
		Schema::create('social_securities', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name_ar');
			$table->string('name_en');
		});
	}

	public function down()
	{
		Schema::drop('social_securities');
	}
}
