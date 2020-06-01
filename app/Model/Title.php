<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use SoftDeletes;
    
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
