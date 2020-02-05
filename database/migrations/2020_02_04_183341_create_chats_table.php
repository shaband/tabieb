<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatsTable extends Migration {

	public function up()
	{
		Schema::create('chats', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('doctor_id')->unsigned()->index();
			$table->bigInteger('patient_id')->unsigned()->index();
			$table->bigInteger('reservation_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('chats');
	}
}