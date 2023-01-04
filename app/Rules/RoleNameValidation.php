<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class RoleNameValidation
 * @package App\Rules
 */
class RoleNameValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^[a-z\-]+$/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute can only contain down case alphabet and \'-\'';
    }
}
