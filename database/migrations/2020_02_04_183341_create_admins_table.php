<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone')->nullable();
			$table->timestamp('blocked_at')->nullable();
			$table->mediumText('blocked_reason')->nullable();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}
}
