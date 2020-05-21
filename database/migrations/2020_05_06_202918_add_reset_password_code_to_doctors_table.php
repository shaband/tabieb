<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetPasswordCodeToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->mediumInteger('reset_password_code')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropIndex(['reset_password_code']);
            $table->dropColumn('reset_password_code');
        });
    }
}
