<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupPermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('group_permission')->truncate();
        DB::table('group_permission')->insert([
                 ['module_name' => 'Administrator', 'form_name' => 'Permission', 'route' => 'user_permission', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.101],
            ['module_name' => 'Administrator', 'form_name' => 'Permission', 'route' => 'user_permission', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.102],
            ['module_name' => 'Administrator', 'form_name' => 'Permission', 'route' => 'user_permission', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.103],
            ['module_name' => 'Administrator', 'form_name' => 'Permission', 'route' => 'user_permission', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.104],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.201],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.202],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.203],
            ['module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.204],

            ['module_name' => 'General Group', 'form_name' => 'Banners', 'route' => 'banners', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.301],
            ['module_name' => 'General Group', 'form_name' => 'Banners', 'route' => 'banners', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.302],
            ['module_name' => 'General Group', 'form_name' => 'Banners', 'route' => 'banners', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.303],
            ['module_name' => 'General Group', 'form_name' => 'Banners', 'route' => 'banners', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.304],
            ['module_name' => 'General Group', 'form_name' => 'Category', 'route' => 'category', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.401],
            ['module_name' => 'General Group', 'form_name' => 'Category', 'route' => 'category', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.402],
            ['module_name' => 'General Group', 'form_name' => 'Category', 'route' => 'category', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.403],
            ['module_name' => 'General Group', 'form_name' => 'Category', 'route' => 'category', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.404],
            ['module_name' => 'General Group', 'form_name' => 'Courses', 'route' => 'courses', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.501],
            ['module_name' => 'General Group', 'form_name' => 'Courses', 'route' => 'courses', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.502],
            ['module_name' => 'General Group', 'form_name' => 'Courses', 'route' => 'courses', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.503],
            ['module_name' => 'General Group', 'form_name' => 'Courses', 'route' => 'courses', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.504],
            
            
       

        ]);
    }
}