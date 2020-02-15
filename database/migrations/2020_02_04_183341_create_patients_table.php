<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration
{

    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('civil_id')->unique()->nullable();
            $table->bigInteger('social_security_id')->unsigned()->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->longText('blocked_reason')->nullable();
            $table->date('birthdate')->nullable();
            $table->date('social_security_at')->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable()->index();
            $table->bigInteger('area_id')->unsigned()->nullable()->index();
            $table->bigInteger('block_id')->unsigned()->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->mediumInteger('verification_code')->unique();
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('gender')->nullable()->default('0');
            $table->longText('fb_token')->nullable();
            $table->longText('google_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('patients');
    }
}
