<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class, // Generador de permisos
            RolAndPermissionSeeder::class,
            RoleSeeder::class,
            RolePermission::class,
            ModelHasRolesSeeder::class,
        ]);
    }
}
