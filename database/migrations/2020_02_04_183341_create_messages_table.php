<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('chat_id')->unsigned()->index();
			$table->longText('message')->nullable();
			$table->morphs('sender');
			$table->timestamp('seen_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('messages');
	}
}