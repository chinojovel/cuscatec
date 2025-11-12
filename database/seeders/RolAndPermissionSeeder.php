<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear el rol "admin" si no existe
        $adminRole = Role::firstOrCreate(['name' => 'Administrator']);

        // Obtener el usuario con ID 1
        $user = User::find(1);

    }
}
