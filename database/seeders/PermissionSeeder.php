<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => '1',
            'name' => 'Admin',
            'permission' => "",
            'created_by' => null,
            'created_at' => '2024-08-06 08:44:23',
            'updated_by' => null,
            'updated_at' => '2024-09-11 11:39:35',
        ]);
    }
}