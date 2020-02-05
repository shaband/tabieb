<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentsTable extends Migration {

	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->longText('file')->unique();
			$table->morphs('model');
			$table->char('ext')->nullable();
			$table->smallInteger('type')->nullable()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('attachments');
	}
}
