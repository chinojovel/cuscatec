<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_backup', function (Blueprint $table) {
            // Campos copiados de la tabla original
            $table->unsignedBigInteger('id'); // No es autoincremental, guardará el ID original
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->date('order_date');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('correlative');
            $table->enum('payment_status', ['P', 'C', 'D'])->default('P');
            $table->string('coupon_code', 191)->nullable();
            $table->string('coupon_type', 191)->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->tinyInteger('type')->default(0);
            $table->decimal('total', 10, 2)->nullable();
            $table->string('tracking_number', 191)->nullable();
            $table->enum('tracking_status', ['N', 'E', 'T', 'I'])->nullable()->default('N');
            $table->unsignedBigInteger('state_id')->default(1);

            // Campo adicional para saber cuándo se borró
            $table->timestamp('deleted_at_backup')->useCurrent();

            // Definimos el ID original como la clave primaria para evitar duplicados
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_backup');
    }
};