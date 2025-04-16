<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'message',
         'created_by',
         'updated_by',
    ];
}