<?php

namespace App\Model;

use App\Model\Project;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'minimum',
        'maximum',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
