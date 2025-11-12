<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('monthly_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('period', 6); // Formato YYYYMM (Ejemplo: 202501)
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->integer('quantity')->default(0);

            // Columnas de bitácora
            $table->foreignId('user_gra')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('user_mod')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // Clave única para evitar duplicados
            $table->unique(['period', 'product_id', 'warehouse_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('monthly_product_stocks');
    }
};
