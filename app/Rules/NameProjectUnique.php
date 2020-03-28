<?php

namespace App\Rules;

use App\Model\Project;
use Illuminate\Contracts\Validation\Rule;

class NameProjectUnique implements Rule
{
    protected $nameCompuest;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($nameCompuest)
    {
        $this->nameCompuest = $nameCompuest;
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
        //dd($this->nameCompuest);
        return Project::where('name',$this->nameCompuest)->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error para nombre repetido.';
    }
}
