<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeRoleAssociation extends Model
{
    protected $fillable = [
        'emp_id',
        'role_id'
    ];
}
