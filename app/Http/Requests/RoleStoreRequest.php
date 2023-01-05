<?php
namespace App\Http\Requests;

use App\Rules\RoleNameValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class RoleStoreRequest
 * @package App\Http\Requests
 */
class RoleStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'guard_name' => [
                'required',
                'string',
                'max:100',
                new RoleNameValidation(),
            ]
        ];
    }
}
