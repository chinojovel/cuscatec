<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(database_path('datos/roles_permissions.json')), true);

        DB::table('role_has_permissions')->insert($data);

        $this->command->info('Roles y permissions data seeded successfully.');
    }
}
