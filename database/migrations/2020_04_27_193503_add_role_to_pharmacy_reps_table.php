<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToPharmacyRepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_reps', function (Blueprint $table) {
            $table->tinyInteger('role')->index()->default(1);//1=>manger,2=>rep
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_reps', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->drop('role');

        });
    }
}
