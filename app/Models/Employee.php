<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'profile_image_name',
        'date_of_birth',
        'current_address',
        'is_same_address'
    ];

    //  /**
    //  * Relation with Role table Through EmployeeRoleAssociation table
    //  *
    //  * @return HasManyThrough
    //  */
    // public function role(): HasManyThrough
    // {
    //     return $this
    //         ->hasManyThrough(
    //             Role::class,
    //             EmployeeRoleAssociation::class,
    //             'emp_id',
    //             'id',
    //             'id',
    //             'role_id'
    //         )
    //         ->where([
    //             'is_client_feature' => true,
    //             'status' => Feature::STATUS_ACTIVE,
    //         ]);
    // }
}
