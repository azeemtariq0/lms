<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'image',
        'path',
         'created_by',
         'updated_by',
    ];
}