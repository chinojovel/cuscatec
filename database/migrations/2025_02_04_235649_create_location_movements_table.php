<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('location_movements', function (Blueprint $table) {
            $table->id(); // Correlativo
            
            // Claves foráneas de document_details
            $table->unsignedBigInteger('document_id');
            $table->string('document_type_code');
            $table->unsignedBigInteger('product_id');

            // Claves foráneas de locations
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('shelf');
            $table->unsignedBigInteger('column');
            $table->unsignedBigInteger('level');

            $table->integer('quantity');
            $table->string('month_year', 6); // Formato "YYYYMM"
            $table->dateTime('operation_date');
            
            // Bitácoras
            $table->unsignedBigInteger('user_gra');
            $table->unsignedBigInteger('user_mod');
            $table->timestamps();
            
            // Clave primaria compuesta
            //$table->unique(['document_id', 'document_type_code', 'product_id', 'warehouse_id', 'zone_id', 'shelf', 'column', 'level'], 'location_movements_pk');
            
            // Claves foráneas con nombres más cortos
            $table->foreign(['document_id', 'document_type_code', 'product_id'], 'location_movements_document_foreign')
                  ->references(['document_id', 'document_type_code', 'product_id'])
                  ->on('document_details');
            
            $table->foreign(['warehouse_id', 'zone_id', 'shelf', 'column', 'level'], 'location_movements_location_foreign')
                  ->references(['warehouse_id', 'zone_id', 'shelf', 'column', 'level'])
                  ->on('locations');
            
            $table->foreign('user_gra', 'location_movements_user_gra_foreign')->references('id')->on('users');
            $table->foreign('user_mod', 'location_movements_user_mod_foreign')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('location_movements');
    }
};
