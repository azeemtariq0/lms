<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{


     protected $fillable = [
          'batch_id',
          'course_id',
          'start_date',
          'end_date',
          'destination',
          'status',
          'created_by',
          'updated_by',
     ];
    public function mollim()
     {
          return $this->hasOne(User::class, 'id', 'mollim_id');
     }
}
