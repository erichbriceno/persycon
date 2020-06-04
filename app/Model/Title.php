<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active'            => 'bool',
    ];
    
    public function setStateAttribute($value)
    {
        $this->attributes['active'] = $value == 'active';
    }

    public function getStateAttribute()
    {
        return $this->active ? 'active' : 'inactive';
    }
    
    public function management()
    {
        return $this->belongsTo(Management::class)->withDefault([
            'name' => 'Unassigned',
        ]);
    }

    public function salaryType()
    {
        return $this->belongsTo(salaryType::class)->withDefault([
            'name' => 'Basico',
        ]);
    }

}
