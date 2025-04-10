<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    

     protected $fillable = [
        'mollim_id',
        'category_id',
        'course_name',
        'course_name_ur',
        'image',
        'course_requirement',
        'course_detail',
        'path',
        'status',
         'created_by',
         'updated_by',
    ];


}
