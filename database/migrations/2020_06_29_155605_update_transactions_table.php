<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('gateway')->nullable()->default('paytabs')->change();
            $table->string('invoice_id')->nullable()->change();
            $table->text('description')->nullable()->after('model_id');
            $table->unsignedBigInteger('credit_transaction_id')->nullable()->index()->after('description');

            $table->foreign('credit_transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->string('gateway')->nullable(false)->default('paytabs')->change();
            $table->string('invoice_id')->nullable(false)->change();

            $table->dropForeign(['credit_transaction_id']);
            $table->dropIndex(['credit_transaction_id']);
            $table->dropColumn('description', 'credit_transaction_id');
        });
    }
}
