<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

class UserQuery extends Builder
{
    use FiltersQueries;

    public function filterRules(): array
    {
        return [
            'search' => 'filled',
            'state' => 'in:active,inactive',
            'management' => 'exists:managements,name',
        ];
    }




    public function filterBySearch($search)
    {
        return $this->whereRaw('CONCAT(names, " ", surnames) like ?', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
            //->orWhereHas('team', function ($query) use ($search) {
            //    $query->where('name', 'like', "%{$search}%");
            //});
    }

    public function filterByState($state)
    {
        return $this->where('active', $state == 'active');
    }

    public function filterByManagement($management)
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