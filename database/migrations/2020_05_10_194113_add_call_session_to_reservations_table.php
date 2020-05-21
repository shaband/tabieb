<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCallSessionToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->boolean('is_quick')->default(0)->after('communication_type');
            $table->longText('session_id')->nullable()->after('description');
            $table->unsignedBigInteger('schedule_id')->nullable()->change();
            $table->time('from_time')->nullable()->change();
            $table->time('to_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_id')->change();
            $table->time('from_time')->change();
            $table->time('to_time')->change();
            $table->dropColumn('is_quick', 'session_id');

        });
    }

}
