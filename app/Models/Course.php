<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'course_code', 'course_name', 'course_duration', 'updated_at', 'created_at'
    ];
    
}
