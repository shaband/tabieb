<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrescriptionItemsTable extends Migration {

	public function up()
	{
		Schema::create('prescription_items', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('prescription_id')->unsigned()->index();
			$table->string('medicine')->nullable();
			$table->string('dose');
			$table->longText('description')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('prescription_items');
	}
}