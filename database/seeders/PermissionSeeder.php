<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\File;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 permisos de prueba
        $jsonPath = base_path('/datos/permissions.json');


        // Verificar si el archivo JSON existe
        if (File::exists($jsonPath)) {
            // Leer el archivo JSON
            $permissions = json_decode(File::get($jsonPath), true);

            // Crear los permisos en la base de datos
            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
        } else {
            // Archivo JSON no encontrado
            $this->command->error('El archivo JSON de permisos no se encuentra.');
        }
    }
}
