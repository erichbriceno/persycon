<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProject extends Pivot
{

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'minimum'   => 'decimal:2',
        'maximum'   => 'decimal:2',
    ];

    public function getCatenAttribute()
    {
        return 1; 
        // return ($this->categories->count())?$this->categories->firstWhere('name','T1'):null; 
    
    }

}
