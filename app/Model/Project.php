<?php

namespace App\Model;

use App\Model\Category;
use Illuminate\Support\Str;
use App\Queries\ProjectQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 
        'description', 
        'start',
        'ending',
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start'     => 'datetime',
        'ending'    => 'datetime',
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
        return new ProjectQuery($query);
    }

    public function getNamewAttribute()
    {
        return Str::words($this->name,1,'');
    }

    public function getYearAttribute()
    {
        return $this->name?Str::after($this->name,' '):null;
    }

    public function getStateAttribute()
    {
        return $this->active?'active':'inactive';
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function getCat1Attribute()
    {
        return ($this->categories->count())?$this->categories->firstWhere('name','T1'):null; 
    }

    public function getCat2Attribute()
    {
        return ($this->categories->count())?$this->categories->firstWhere('name','T2'):null; 
    }
    
    public function getCat3Attribute()
    {
        return ($this->categories->count())?$this->categories->firstWhere('name','T3'):null; 
    }

    public function getCat4Attribute()
    {
        return ($this->categories->count())?$this->categories->firstWhere('name','T4'):null; 
    }

    public function getLoadcategoriesAttribute()
    {
        return $this->cat1->minimum && $this->cat2->minimum && $this->cat3->minimum && $this->cat4->minimum && $this->cat1->maximum && $this->cat2->maximum && $this->cat3->maximum && $this->cat4->maximum;
    }
}
