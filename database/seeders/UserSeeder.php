<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'permission_id' => '["1"]',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('demo@123'),
            'is_admin'=>1
        ]);


        // permission 
        DB::table('permission_user')->truncate();
        DB::table('permission_user')->insert([
            'user_id' => 1,
            'permission_id' => 1
        ]);


    }
}