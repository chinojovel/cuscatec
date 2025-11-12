<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('shelf'); // Estante
            $table->unsignedBigInteger('column'); // Columna
            $table->unsignedBigInteger('level'); // Nivel
            $table->boolean('ban_estado')->default(true);
            $table->unsignedBigInteger('user_gra');
            $table->unsignedBigInteger('user_mod');
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['warehouse_id', 'zone_id', 'shelf', 'column', 'level']);

            // Claves foráneas
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('user_gra')->references('id')->on('users');
            $table->foreign('user_mod')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
