<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidValueCategory implements Rule
{
    protected $values;

    /**
     * Create a new rule instance.
     *
     * @return void
     */ 
    public function __construct($min1, $max1, $min2, $max2, $min3, $max3, $min4, $max4)
    {   
        $this->values = [
            'min1' => $min1,
            'max1' => $max1,
            'min2' => $min2,
            'max2' => $max2,
            'min3' => $min3,
            'max3' => $max3,
            'min4' => $min4,
            'max4' => $max4,
        ];
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
        switch ($attribute) 
        {
            case "min1": return ($value < $this->values['max1']) && ($value < $this->values['min2']) && ($value < $this->values['max2']) && ($value < $this->values['min3']) && ($value < $this->values['max3']) && ($value < $this->values['min4']) && ($value < $this->values['max4']); break;
            case "max1": return ($value > $this->values['min1']) && ($value < $this->values['min2']) && ($value < $this->values['max2']) && ($value < $this->values['min3']) && ($value < $this->values['max3']) && ($value < $this->values['min4']) && ($value < $this->values['max4']); break;
            case "min2": return ($value > $this->values['min1']) && ($value > $this->values['max1']) && ($value < $this->values['max2']) && ($value < $this->values['min3']) && ($value < $this->values['max3']) && ($value < $this->values['min4']) && ($value < $this->values['max4']); break;
            case "max2": return ($value > $this->values['min1']) && ($value > $this->values['max1']) && ($value > $this->values['min2']) && ($value < $this->values['min3']) && ($value < $this->values['max3']) && ($value < $this->values['min4']) && ($value < $this->values['max4']); break;
            case "min3": return ($value > $this->values['min1']) && ($value > $this->values['max1']) && ($value > $this->values['min2']) && ($value > $this->values['max2']) && ($value < $this->values['max3']) && ($value < $this->values['min4']) && ($value < $this->values['max4']); break;
            case "max3": return ($value > $this->values['min1']) && ($value > $this->values['max1']) && ($value > $this->values['min2']) && ($value > $this->values['max2']) && ($value > $this->values['min3']) && ($value < $this->values['min4']) && ($value < $this->values['max4']); break;
            case "min4": return ($value > $this->values['min1']) && ($value > $this->values['max1']) && ($value > $this->values['min2']) && ($value > $this->values['max2']) && ($value > $this->values['min3']) && ($value > $this->values['max3']) && ($value < $this->values['max4']); break;
            case "max4": return ($value > $this->values['min1']) && ($value > $this->values['max1']) && ($value > $this->values['min2']) && ($value > $this->values['max2']) && ($value > $this->values['min3']) && ($value > $this->values['max3']) && ($value > $this->values['min4']); break;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories.errorsValidations.validMin');
    }
}
