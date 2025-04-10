<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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

         
    if(Schema::hasTable('permissions')){
        // Retrieve all permissions from the database
        $permissions = Permission::all();


        foreach ($permissions as $permission) {

            $abilities = json_decode($permission->permission,true);
    
           if(!empty($abilities))
            foreach ($abilities as $category => $actions) {
                foreach ($actions as $action => $value) {
                    if ($value == "1") {
                            // dd($abilities);
                        // Define the gate dynamically for each action in the permission
                        Gate::define("{$category}.{$action}", function (User $user) use ($permission, $category, $action) {
                            return $user->hasPermissionTo($category, $action);
                        });
                    }
                }
            }
        }
    }
    }
}






