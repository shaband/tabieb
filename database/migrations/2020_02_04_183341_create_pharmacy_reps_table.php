<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePharmacyRepsTable extends Migration {

	public function up()
	{
		Schema::create('pharmacy_reps', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone')->nullable();
			$table->timestamp('blocked_at')->nullable();
			$table->mediumText('blocked_reason')->nullable();
			$table->bigInteger('pharmacy_id')->unsigned();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamp('phone_verified_at')->nullable();
			$table->smallInteger('verification_code');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pharamacy_reps');
	}
}
