<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration
{

    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('doctor_id')->unsigned()->index();
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->bigInteger('schedule_id')->unsigned()->index();
            $table->date('date');
            $table->time('from_time');
            $table->time('to_time');
            $table->tinyInteger('communication_type')->unsigned()->nullable()->default(0);
            $table->timestamp('canceled_at')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('reservations');
    }
}
