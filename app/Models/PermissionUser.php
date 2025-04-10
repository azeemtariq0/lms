<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'permission_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'permission_id',
        'created_at',
    ];




}