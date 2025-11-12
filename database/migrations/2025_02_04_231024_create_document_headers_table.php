<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('document_headers', function (Blueprint $table) {
            $table->unsignedBigInteger('id'); // Se usa como PK sin autoincremento
            $table->string('document_type_code'); // Código del tipo de documento
            $table->unsignedBigInteger('warehouse_id');
            $table->boolean('ban_estado')->default(true);
            $table->unsignedBigInteger('user_gra');
            $table->unsignedBigInteger('user_mod');
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['id', 'document_type_code']);

            // Claves foráneas
            $table->foreign(['warehouse_id', 'document_type_code'])
                  ->references(['warehouse_id', 'document_type_code'])
                  ->on('warehouse_movements');

            $table->foreign('user_gra')->references('id')->on('users');
            $table->foreign('user_mod')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_headers');
    }
};
