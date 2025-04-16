<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
    
     protected $table = 'batches';
     protected $fillable = [
        'batch_title',
        'course_id',
        'course_duration',
        'course_duration_days',
        'no_of_questions',
        'total_marks',
        'time_limit',
        'no_of_easy_question',
        'no_of_medium_question',
        'no_of_hard_question',
        'year',
        'month',
        'start_date',
        'end_date',
         'created_by',
         'updated_by',
    ];


}
