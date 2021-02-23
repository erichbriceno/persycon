<?php

namespace App\Model;

use App\Queries\CoordinationQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coordination extends Model
{
    use SoftDeletes;
    public $table = "coordinations";

    protected $fillable = [
        'name', 
        'description',
        'management_id', 
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

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new CoordinationQuery($query);
    }

    public function management()
    {
        return $this->belongsTo(Management::class)->withDefault([
            'name' => 'Unassigned',
        ]);
    }

}
