<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use Illuminate\Database\Seeder;

class GroupPermissionsSeeder extends Seeder
{
    public function run()
    {
        GroupPermission::truncate()->insert([
            ['id' => 1, 'module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.101],
            ['id' => 2, 'module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.102],
            ['id' => 3, 'module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.103],
            ['id' => 4, 'module_name' => 'Administrator', 'form_name' => 'User Permission', 'route' => 'user_permission', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.104],
            ['id' => 5, 'module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.201],
            ['id' => 6, 'module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.202],
            ['id' => 7, 'module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.203],
            ['id' => 8, 'module_name' => 'Administrator', 'form_name' => 'User', 'route' => 'user', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.204],
            ['id' => 9, 'module_name' => 'General', 'form_name' => 'banners', 'route' => 'banners', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.301],
            ['id' => 10, 'module_name' => 'General', 'form_name' => 'banners', 'route' => 'banners', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.302],
            ['id' => 11, 'module_name' => 'General', 'form_name' => 'banners', 'route' => 'banners', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.303],
            ['id' => 12, 'module_name' => 'General', 'form_name' => 'banners', 'route' => 'banners', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.304],
            ['id' => 13, 'module_name' => 'General', 'form_name' => 'category', 'route' => 'categories', 'permission_id' => 'list', 'permission_name' => 'List', 'sort_order' => 1.401],
            ['id' => 14, 'module_name' => 'General', 'form_name' => 'category', 'route' => 'categories', 'permission_id' => 'add', 'permission_name' => 'Add', 'sort_order' => 1.402],
            ['id' => 15, 'module_name' => 'General', 'form_name' => 'category', 'route' => 'categories', 'permission_id' => 'edit', 'permission_name' => 'Edit', 'sort_order' => 1.403],
            ['id' => 16, 'module_name' => 'General', 'form_name' => 'category', 'route' => 'categories', 'permission_id' => 'delete', 'permission_name' => 'Delete', 'sort_order' => 1.404],
        ]);
    }
}

// command
// php artisan db:seed --class=GroupPermissionsSeeder
