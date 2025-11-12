<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(database_path('datos/model_has_roles.json')), true);

        DB::table('model_has_roles')->insert($data);

        $this->command->info('Model Has Roles data seeded successfully.');
    }
}
