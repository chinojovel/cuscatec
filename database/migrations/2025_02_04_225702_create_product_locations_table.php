<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('shelf'); // Estante
            $table->unsignedBigInteger('column'); // Columna
            $table->unsignedBigInteger('level'); // Nivel
            $table->integer('quantity');
            $table->enum('location_type', ['M', 'H']); // M = Madre, H = Hija
            $table->boolean('ban_estado')->default(true);
            $table->unsignedBigInteger('user_gra');
            $table->unsignedBigInteger('user_mod');
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['product_id', 'warehouse_id', 'zone_id', 'shelf', 'column', 'level']);

            // Claves foráneas
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('user_gra')->references('id')->on('users');
            $table->foreign('user_mod')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_locations');
    }
};
