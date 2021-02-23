<?php

namespace App\Model;

use App\Queries\ManagementQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Management extends Model
{
    use SoftDeletes;
    public $table = "managements";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'acronym',
        'name',
        'description',
        'selectable',
    ];

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new ManagementQuery($query);
    }
}
