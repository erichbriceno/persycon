<?php

namespace App\Rules;

use App\Model\Project;
use Illuminate\Contracts\Validation\Rule;

class Minimum1Valid implements Rule
{
    protected $max1;
    protected $min2;
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
    public function __construct($max1, $min2, $max2, $min3, $max3, $min4, $max4)
    {   
        $this->max1 = $max1;
        $this->min2 = $min2;
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
        return ($value < $this->max1) && ($value < $this->min2) && ($value < $this->max2) && ($value < $this->min3) && ($value < $this->max3) && ($value < $this->min4) && ($value < $this->max4);
        
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
