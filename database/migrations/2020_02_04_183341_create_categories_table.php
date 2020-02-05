<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar')->nullable();
			$table->string('name_en')->nullable();
			$table->bigInteger('category_id')->unsigned()->index()->nullable();
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->timestamp('blocked_at');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
