<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table = 'student_class';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $appends = ["class_grade", "student_name", "student_nis", "student_nisn"];
    protected $fillable = ["id", "student_id", "class_id"];

    public function student_detail()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }

    public function classroom_detail()
    {
        return $this->hasOne('App\Models\PivotClass', 'id', 'class_id');
    }
    
    public function getClassGradeAttribute()
    {
        $data = $this->classroom_detail()->first();
        return $data->grade;
    }
    
    public function getStudentNameAttribute()
    {
        $data = $this->student_detail()->first();
        return $data->name;
    }

    public function getStudentNisAttribute()
    {
        $data = $this->student_detail()->first();
        return $data->nis;
    }

    public function getStudentNisnAttribute()
    {
        $data = $this->student_detail()->first();
        return $data->nisn;
    }
}
