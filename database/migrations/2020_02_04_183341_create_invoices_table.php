<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	public function up()
	{
		Schema::create('invoices', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->bigInteger('reservation_id')->unsigned()->index();
			$table->bigInteger('patient_id')->unsigned()->index();
			$table->tinyInteger('type')->unsigned()->nullable()->default('1');
			$table->tinyInteger('gateway')->unsigned()->nullable()->default('1');
			$table->decimal('amount')->nullable()->index();
			$table->string('gateway_invoice_id')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('invoices');
	}
}