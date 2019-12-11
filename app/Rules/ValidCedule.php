<?php

namespace App\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class ValidCedule implements Rule
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
        $nat  =  Str::substr($value, 0, 1);
        $num = filter_var(
            (int) Str::substr($value, 1, 10),
            FILTER_VALIDATE_INT,
            array("options" => array("min_range"=>300000, "max_range"=>90000000)));

        return ($nat === 'V' || $nat === 'E') && $num && Str::length($value) < 10 ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.cedule');
    }
}
