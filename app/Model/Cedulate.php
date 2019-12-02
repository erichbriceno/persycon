<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cedulate extends Model
{

    const FIRST_NAME = 'primernombre';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'saime_datos_AC';


    public function getNameAttribute()
    {
        return "{$this->primernombre} {$this->segundonombre} {$this->primerapellido} {$this->segundoapellido}";
    }

    public function getNamesAttribute()
    {
        return "{$this->primernombre} {$this->segundonombre}";
    }

    public function getSurnameAttribute()
    {
        return "{$this->primerapellido} {$this->segundoapellido}";
    }

    public function getBirthdateAttribute()
    {
        return $this->fechanacimiento;
    }

    public function getCeduleAttribute()
    {
        return "{$this->letra}{$this->numerocedula}";
    }



}
