<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePharmaciesTable extends Migration {

	public function up()
	{
		Schema::create('pharmacies', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar')->nullable();
			$table->string('name_en');
			$table->string('phone')->nullable();
			$table->text('address_ar')->nullable();
			$table->string('address_en')->nullable();
			$table->bigInteger('district_id')->unsigned()->nullable()->index();
			$table->bigInteger('area_id')->unsigned()->nullable();
			$table->bigInteger('block_id')->unsigned()->nullable()->index();
			$table->string('email')->unique()->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamp('phone_verified_at')->nullable();
			$table->smallInteger('verification_code');
			$table->timestamp('blocked_at')->nullable();
			$table->text('blocked_reason')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pharmacies');
	}
}