<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [
        'start_year', 'end_year', 'isActive',  'created_at', 'updated_at'
    ];
}
