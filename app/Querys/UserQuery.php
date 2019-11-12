<?php

namespace App\Querys;

use Illuminate\Database\Eloquent\Builder;

class UserQuery extends Builder
{
    public function search($search)
    {
        if( empty($search)) {
            return $this;
        }

        return $this->whereRaw('CONCAT(names, " ", surnames) like ?', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
            //->orWhereHas('team', function ($query) use ($search) {
            //    $query->where('name', 'like', "%{$search}%");
            //});
    }

    public function byState($state)
    {
        if ($state == 'active') {
            return $this->where('active', true);
        }
        if ($state == 'inactive') {
            return $this->where('active', false);
        }
        return $this;
    }

    public function byManagement($management)
    {
        if(!empty($management)) {
            if($management === 'Unassigned') {
                $this->where('management_id', null);
            }else {
                $this->whereHas('management', function ($query) use ($management) {
                    $query->where('name', $management);
                });
            }
        }
        return $this;
    }
}