<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

class TrashedQuery extends Builder
{

    public function onlyTrashedIf($trashed)
    {
        if ($trashed) {
            $this->onlyTrashed();
        }
        return $this;
    }

    public function filterBy(QueryFilter $filters, array $data)
    {
        return $filters->applyTo($this, $data);
    }
}