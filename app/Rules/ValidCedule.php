<?php

namespace App\Rules;

use App\Model\Cedulate;
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
        return  $this->validNationality($value) &&
                $this->validNumberCed($value) &&
                Str::length($value) < 10 &&
                $this->validCeduleExist($value);
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

    private function validNationality($cedule)
    {
        return (Str::substr($cedule, 0, 1) === 'V' || Str::substr($cedule, 0, 1) === 'E');
    }

    private function validNumberCed($cedule)
    {
        return filter_var(
            (int) Str::substr($cedule, 1, 8),
            FILTER_VALIDATE_INT,
            array("options" => array("min_range"=>300000, "max_range"=>90000000))) != false;
    }

    private function validCeduleExist($cedule)
    {
        return Cedulate::where('letra', Str::substr($cedule, 0, 1))->where('numerocedula', (int) Str::substr($cedule, 1, 8))->count() != 0;
    }
}
