<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTeacher extends Model
{
    protected $table = 'teacher_to_course';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $appends      = ["teacher_name", "course_name", "school_year"];
    protected $fillable = [
        'teacher_id', 'course_id', 'year_id', 'created_at', 'updated_at'
    ];


    public function getTeacherNameAttribute()
    {
        $teacher = Teacher::select('name')->where('id', '=', $this['teacher_id'])->first();
        return $teacher->name;
    }

    public function getCourseNameAttribute()
    {
        $course = Course::select('course_name')->where('id', '=', $this['course_id'])->first();
        return $course->course_name;
    }
    
    public function getSchoolYearAttribute()
    {
        $year = SchoolYear::select('start_year', 'end_year')->where('id', '=', $this['year_id'])->first();
        return $year->start_year.'/'.$year->end_year;
    }
}
