<?php

namespace App\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 
        'description', 
        'start',
        'ending',
        'state'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start'     => 'datetime',
        'ending'    => 'datetime',
        'state'     => 'boolean'
    ];

    public function getNamewAttribute()
    {
        return Str::words($this->name,1,'');
    }

    public function getYearAttribute()
    {
        return $this->name?Str::after($this->name,' '):null;
    }

}
