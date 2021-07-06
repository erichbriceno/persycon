<?php

namespace App\Model;

use Carbon\Carbon;
use App\Queries\TrashedQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{   
    use SoftDeletes;



    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new TrashedQuery($query);
    }


    public function getNameAttribute()
    {
        return ucwords(strtolower("{$this->names} {$this->surnames}"));;
    }

    public function getCeduleAttribute()
    {
        return "{$this->nat}{$this->numberced}";
    }

    public function getGenerAttribute()
    {
        return $this->gender;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age;
    }

}
