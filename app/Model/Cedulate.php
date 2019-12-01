<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cedulate extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'saime_datos_AC';


    public function getNamesAttribute()
    {
        return "{$this->primernombre} {$this->segundonombre}";
    }

    public function getNameAttribute()
    {
        return "{$this->primernombre} {$this->segundonombre} {$this->primerapellido} {$this->segundoapellido}";
    }

}
