<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id')->index();
            $table->morphs('creator');
            $table->unsignedBigInteger('reservation_id')->index()->nullable();
            $table->unsignedBigInteger('category_id')->index()->nullable();
            $table->string('title');
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();


            $table->foreign('reservation_id')->on('reservations')->references('id')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('patient_id')->on('patients')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
}
