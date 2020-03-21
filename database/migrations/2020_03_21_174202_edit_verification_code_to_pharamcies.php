<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditVerificationCodeToPharamcies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacies', function (Blueprint $table) {
            $table->string('verification_code')->change();

        });
        Schema::table('patients', function (Blueprint $table) {
            $table->string('verification_code')->change();

        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('verification_code')->change();

        });
        Schema::table('pharmacy_reps', function (Blueprint $table) {
            $table->string('verification_code')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {      Schema::table('pharmacies', function (Blueprint $table) {
        $table->smallInteger('verification_code')->change();

    });
        Schema::table('patients', function (Blueprint $table) {
            $table->smallInteger('verification_code')->change();

        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->smallInteger('verification_code')->change();

        });
        Schema::table('pharmacy_reps', function (Blueprint $table) {
            $table->smallInteger('verification_code')->change();

        });
    }
}
