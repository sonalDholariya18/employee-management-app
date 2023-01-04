<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClientStoreRequest
 * @package App\Http\Requests\System\Client
 */
class EmployeeStoreRequest extends FormRequest
{
 /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
                'first_name' => [
                    'required',
                    'max:50',
                ],
                'last_name' => [
                    'required',
                    'max:50',
                ],
                'email' => [
                    'required',
                    'email',
                ],
                'profile_image_name' => [
                    'mimes:jpeg,jpg,png,gif',
                    'max:10000' //maximum allow to 10000kb
                ],
                'date_of_birth' => [
                    'required',
                    'before:today',
                ],
                'current_address' => [
                    'required',
                    'string',
                ],
                'roles' => [
                    'required'
                ]
        ];
    }
}
