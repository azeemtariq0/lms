<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = $this->getPermissionsFromControlAccess();
        Permission::truncate()->insert([
            'id' => '1',
            'name' => 'Global Admin Access',
            'permission' => json_encode($permissions),
            'created_at' => Carbon::now()
        ]);
    }
    private function getPermissionsFromControlAccess()
    {

        $controlAccess = GroupPermission::select('route', 'permission_id')->get();
        $permissions = [];

        foreach ($controlAccess as $entry) {
            if (!isset($permissions[$entry->route])) {
                $permissions[$entry->route] = [];
            }
            $permissions[$entry->route][$entry->permission_id] = 1;
        }
        return $permissions;
    }
}
