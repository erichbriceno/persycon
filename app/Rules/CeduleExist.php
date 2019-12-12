<?php

namespace App\Rules;

use App\Model\Cedulate;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class CeduleExist implements Rule
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
        return Cedulate::where('letra', Str::substr($value, 0, 1))->where('numerocedula', (int) Str::substr($value, 1, 8))->count() == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.ceduleexist');
    }

}
