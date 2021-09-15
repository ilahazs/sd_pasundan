<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade';
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'grade', 'created_at', 'updated_at'
    ];
}
