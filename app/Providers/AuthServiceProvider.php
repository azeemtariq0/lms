<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        // Retrieve all permissions from the database
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            // Define gates for each action in the permission JSON
            // dd($permission->permission );
            $abilities = $permission->permission;



            foreach ($abilities as $category => $actions) {
                foreach ($actions as $action => $value) {
                    if ($value == "1") {
                            // dd($action);
                        // Define the gate dynamically for each action in the permission
                        Gate::define("{$category}.{$action}", function (User $user) use ($permission, $category, $action) {


                            return $user->hasPermission($category, $action);
                        });
                    }
                }
            }
        }
    }
}
