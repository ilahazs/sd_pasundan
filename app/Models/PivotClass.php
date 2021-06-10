<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotClass extends Model
{
    protected $table = 'pivot_class';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $appends      = ["grade", "school_year"];
    protected $fillable = [
        'grade_id', 'variable_id', 'year_id', 'created_at', 'updated_at'
    ];


    public function getGradeAttribute()
    {
        $grade = Grade::select('grade')->where('id', '=', $this['grade_id'])->first();
        $variable = GradeVariable::select('variable')->where('id', '=', $this['variable_id'])->first();
        return $grade->grade.' '.$variable->variable;
    }

    public function getSchoolYearAttribute()
    {
        $year = SchoolYear::select('start_year', 'end_year')->where('id', '=', $this['year_id'])->first();
        return $year->start_year.'/'.$year->end_year;
    }

    public function student_list()
    {
        return $this->hasMany('App\Models\StudentClass', 'class_id', 'id');
    }
}
