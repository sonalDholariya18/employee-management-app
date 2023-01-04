<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermanentAddress extends Model
{
    protected $fillable = [
        'emp_id',
        'address'
    ];
}
