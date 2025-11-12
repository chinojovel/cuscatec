<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorrelAndStatusToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add the correlative column, making it auto-incremental
            $table->bigInteger('correlative')->nullable(false);
            // Add the payment_status column with specific allowed values and a comment
            $table->enum('payment_status', ['P', 'C', 'D'])
                ->comment('P = pending, C = check, D = paid')
                ->default('P');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the columns if the migration is rolled back
            $table->dropColumn('correlative');
            $table->dropColumn('payment_status');
        });
    }
}
