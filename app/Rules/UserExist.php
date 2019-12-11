<?php

namespace App\Rules;

use App\Model\User;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class UserExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return User::where('nat', Str::substr($value, 0, 1))->where('numberced', (int) Str::substr($value, 1, 8))->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.usercreate');
    }
}
