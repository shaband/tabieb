<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlocksTable extends Migration {

	public function up()
	{
		Schema::create('blocks', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar');
			$table->string('name_en');
			$table->bigInteger('area_id')->unsigned()->index();
			$table->timestamp('blocked_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('blocks');
	}
}