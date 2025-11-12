<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('document_details', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->string('document_type_code'); // Debe coincidir con document_headers
            $table->unsignedBigInteger('product_id');
            $table->integer('requested_quantity');
            $table->integer('dispatched_quantity')->default(0);
            $table->boolean('ban_estado')->default(true);
            $table->unsignedBigInteger('user_gra');
            $table->unsignedBigInteger('user_mod');
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['document_id', 'document_type_code', 'product_id']);

            // Claves foráneas correctamente definidas
            $table->foreign('document_id')->references('id')->on('document_headers');
            $table->foreign(['document_id', 'document_type_code'])
                ->references(['id', 'document_type_code'])
                ->on('document_headers');

            $table->foreign('product_id')->references('id')->on('products');

            $table->foreign('user_gra')->references('id')->on('users');
            $table->foreign('user_mod')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_details');
    }
};
