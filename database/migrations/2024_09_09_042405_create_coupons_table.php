<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Código del cupón
            $table->decimal('discount_amount', 8, 2)->nullable(); // Monto de descuento
            $table->integer('discount_percentage')->nullable(); // Monto de descuento
            $table->enum('type', ['a', 'p'])->default('a'); // tipo del cupón a= amount p = percentage
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Estado del cupón
            $table->date('start_date'); // Fecha de inicio
            $table->date('end_date'); // Fecha de fin
            $table->softDeletes(); // Soft delete
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
