<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => '1',
            'name' => 'Admin',
            'permission' => json_encode([
                'user_permission' => ['list' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1],
                'user' => ['list' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1],

            ]),
            'created_by' => null,
            'created_at' => '2024-08-06 08:44:23',
            'updated_by' => null,
            'updated_at' => '2024-09-11 11:39:35',
        ]);
    }
}