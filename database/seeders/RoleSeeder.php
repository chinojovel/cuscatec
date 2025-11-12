<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $data = json_decode(File::get(database_path('datos/roles.json')), true);

            DB::table('roles')->insert($data);

            $this->command->info('Roles data seeded successfully.');
        }
    }
}
