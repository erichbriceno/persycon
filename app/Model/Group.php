<?php

namespace App\Model;

use App\Queries\GroupQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    public $table = "groups";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'coordination_id',
    ];

    // /**
    //  * Create a new Eloquent query builder for the model.
    //  *
    //  * @param  \Illuminate\Database\Query\Builder  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|static
    //  */
    // public function newEloquentBuilder($query)
    // {
    //     return new GroupQuery($query);
    // }

    public function coordination()
    {
        return $this->belongsTo(Coordination::class);
    }

}
