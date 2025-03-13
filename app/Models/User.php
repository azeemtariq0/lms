<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


   public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains(function ($perm) use ($permission) {
            return $perm->name === $permission;
        });
    }

    // Check if the user has a specific permission
    public function hasPermissionTo($type ,$action, )
    {
        $permission_id = Session::get('permission_id');
        $permissions = $this->permissions()->where('permission_id', $permission_id)->first()->permission ?? [];
        return isset($permissions[$type][$action]) && $permissions[$type][$action] == '1';
    }

}
