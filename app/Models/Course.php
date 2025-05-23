<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{


     protected $fillable = [
          'mollim_id',
          'category_id',
          'course_name',
          'slug',
          'course_name_ur',
          'image',
          'course_requirement',
          'course_detail',
          'path',
          'status',
          'created_by',
          'updated_by',
     ];
    public function mollim()
     {
          return $this->hasOne(User::class, 'id', 'mollim_id');
     }
     public function attachments()
     {
          return $this->hasMany(CourseAttachments::class, 'course_id', 'id');
     }
     public function lectures()
     {
          return $this->hasMany(CourseLectures::class, 'course_id', 'id');
     }
}
