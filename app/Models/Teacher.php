<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';
    protected $fillable = [
        'id', 'user_id', 'name', 'nip', 'gender', 'phone'
    ];
}
