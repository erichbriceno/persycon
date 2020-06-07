<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProject extends Pivot
{

    public function getCatenAttribute()
    {
        return 1; 
        // return ($this->categories->count())?$this->categories->firstWhere('name','T1'):null; 
    
    }

}
