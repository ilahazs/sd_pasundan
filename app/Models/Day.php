<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];
}
