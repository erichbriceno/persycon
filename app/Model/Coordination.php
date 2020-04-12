<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coordination extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'description', 
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active'    => 'boolean'
    ];

}
