<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentStatusHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_status_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->enum('payment_status', ['P', 'C', 'D'])->default('P'); // P = pending, C = check, D = paid
            $table->bigInteger('user_id')->unsigned()->nullable(); // The user who made the change (optional)
            $table->timestamp('changed_at')->useCurrent(); // Timestamp of when the status was changed
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_status_histories');
    }
}
