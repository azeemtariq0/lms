<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'permission'
    ];

    protected $casts = [
        'permission' => 'array', // ensures the permission column is treated as an array
    ];

     public function users()
    {
        return $this->belongsToMany(User::class);
    }


}