<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $fillable = [
        'id', 'user_id','name', 'nis', 'nisn', 'gender', 'phone'
    ];
}
