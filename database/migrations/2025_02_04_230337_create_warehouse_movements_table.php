<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('warehouse_movements', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->string('document_type_code'); // Código del tipo de documento
            $table->string('description');
            $table->integer('operator'); // 1 = Entrada, -1 = Salida
            $table->boolean('ban_estado')->default(true);
            $table->unsignedBigInteger('user_gra');
            $table->unsignedBigInteger('user_mod');
            $table->timestamps();

            // Claves primarias compuestas
            $table->primary(['warehouse_id', 'document_type_code']);

            // Claves foráneas (sin null ni delete cascade)
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('user_gra')->references('id')->on('users');
            $table->foreign('user_mod')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouse_movements');
    }
};
