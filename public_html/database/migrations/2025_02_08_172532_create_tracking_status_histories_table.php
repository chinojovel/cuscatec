<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingStatusHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('tracking_status_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->enum('tracking_status', ['N', 'E', 'T', 'I'])->default('N'); // N = new, E = en route, T = delivered, I = issue
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
        Schema::dropIfExists('tracking_status_histories');
    }
}
