<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifica el tipo ENUM para agregar la nueva opción 'I'
        DB::statement("ALTER TABLE orders MODIFY COLUMN tracking_status ENUM('N', 'E', 'T', 'I') DEFAULT 'N'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al tipo ENUM original sin la opción 'I'
        DB::statement("ALTER TABLE orders MODIFY COLUMN tracking_status ENUM('N', 'E', 'T') DEFAULT 'N'");
    }
};
