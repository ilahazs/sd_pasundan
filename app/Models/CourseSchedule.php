<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
        'class_id', 'c_teacher_id', 'day_id', 'start_hour', 'end_hour', 'updated_at', 'created_at'
    ];

    protected $appends = ["class_name", "teacher_name", "course_name", "day_name"];

    
    public function classroom()
    {
        return $this->hasOne('App\Models\PivotClass', 'id', 'class_id');
    }

    public function course_teacher()
    {
        return $this->hasOne('App\Models\CourseTeacher', 'id', 'c_teacher_id');
    }

    public function getDayNameAttribute()
    {
        $data = Day::select('name')->where('id', '=', $this['day_id'])->first();
        return $data->name;
    }

    public function getTeacherNameAttribute()
    {
        $data = $this->course_teacher()->first();
        return $data->teacher_name;
    }

    public function getCourseNameAttribute()
    {
        $data = $this->course_teacher()->first();
        return $data->course_name;
    }
    
    public function getClassNameAttribute()
    {
        $data1 = $this->classroom()->first();
        return $data1->grade;
    }
}
