<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $permission = Permission::first();
        User::truncate()->insert(
            [
                'permission_id' => json_encode([$permission->id]),
                'email' => 'admin@gmail.com',
                'name' => 'Global Admin',
                'password' => Hash::make(12345),
                'is_admin' => 1,
                'created_at' => Carbon::now(),
            ]

        );

        $user = User::first();
        PermissionUser::truncate()->insert(

            [
                'user_id' => $user->id,
                'permission_id' => $permission->id,
                'created_at' => Carbon::now(),
            ]

        );
    }
}
