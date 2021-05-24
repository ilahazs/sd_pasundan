<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeVariable extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [
        'variable', 'created_at', 'updated_at'
    ];
}
