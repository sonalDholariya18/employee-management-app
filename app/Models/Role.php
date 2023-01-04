<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'guard_name'
    ];

    // /**
    //  * @return HasMany
    //  */
    // public function roleAssociation(): HasMany
    // {
    //     return $this->hasMany(EmployeeRoleAssociation::class, 'role_id');
    // }
}
