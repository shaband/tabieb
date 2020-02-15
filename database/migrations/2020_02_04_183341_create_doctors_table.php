<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorsTable extends Migration
{

    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name_en');
            $table->string('last_name_en')->nullable();
            $table->string('last_name_ar');
            $table->string('first_name_ar')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->bigInteger('category_id')->unsigned();
            $table->char('price')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->longText('blocked_reason')->nullable();
            $table->string('civil_id')->unique()->nullable();
            $table->tinyInteger('period')->unsigned()->nullable();
            $table->smallInteger('verification_code')->unique()->unsigned()->nullable();
            $table->rememberToken();
            $table->tinyInteger('gender')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('doctors');
    }
}
