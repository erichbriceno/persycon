<?php

namespace App\Rules;

use App\Model\Project;
use Illuminate\Contracts\Validation\Rule;

class Minimum2Valid implements Rule
{
    protected $min1;
    protected $max1;
    protected $max2;
    protected $min3;
    protected $max3;
    protected $min4;
    protected $max4;

    /**
     * Create a new rule instance.
     *
     * @return void
     */ 
    public function __construct($min1, $max1, $max2, $min3, $max3, $min4, $max4)
    {   
        $this->min1 = $min1;
        $this->max1 = $max1;
        $this->max2 = $max2;
        $this->min3 = $min3;
        $this->max3 = $max3;
        $this->min4 = $min4;
        $this->max4 = $max4;
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
        return ($value > $this->min1) && ($value > $this->max1) && ($value < $this->max2) && ($value < $this->min3) && ($value < $this->max3) && ($value < $this->min4) && ($value < $this->max4);
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        //return trans('projects.errorsValidations.name.uniqueName',['name' => $this->nameCompuest]);
    }
}
