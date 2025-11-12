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
        Schema::create('order_details_backup', function (Blueprint $table) {
            // Campos copiados de la tabla original
            $table->unsignedBigInteger('id'); // No autoincremental, guarda el ID original
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('original_price', 10, 2);
            $table->decimal('final_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Campo adicional para saber cuándo se borró
            $table->timestamp('deleted_at_backup')->useCurrent();

            // Clave primaria para evitar duplicados del mismo detalle borrado
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
        Schema::dropIfExists('order_details_backup');
    }
};