<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrescriptionsTable extends Migration
{

    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reservation_id')->unsigned()->index();
            $table->bigInteger('doctor_id')->unsigned()->index();
            $table->char('code')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('phramacy_id')->unsigned()->nullable()->index();
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->bigInteger('phramacy_rep_id')->unsigned()->nullable()->index();
            $table->timestamp('phramacy_took_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('prescriptions');
    }
}
