<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->nullableMorphs('model');
			$table->string('subject')->nullable();
			$table->longText('message')->nullable();
			$table->timestamp('seen_at')->nullable();
			$table->bigInteger('seen_by')->unsigned()->nullable()->index();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
