<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

class ProjectQuery extends Builder
{

    public function onlyTrashedIf($trashed)
    {
        if ($trashed) {
            $this->onlyTrashed();
        }
        return $this;
    }

}