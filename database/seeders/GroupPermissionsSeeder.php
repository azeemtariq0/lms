<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupPermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('group_permission')->insert([
                 ['module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.101],
            ['module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.102],
            ['module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.103],
            ['module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.104],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.201],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.202],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.203],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.204],
            
            
       

        ]);
    }
}