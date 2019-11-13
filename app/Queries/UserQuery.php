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
            'roles' => 'array|exists:roles,name',
        ];
    }

    public function filterBySearch($search)
    {
        //$this->whereRaw('CONCAT(names, " ", surnames) like ?', "%{$search}%")
        //    ->orWhere('email', 'like', "%{$search}%");

        $this->where(function ($query) use ($search) {
            $query->whereRaw('CONCAT(names, " ", surnames) like ?', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
        });
        return $this;
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

    public function filterByRoles(array $roles)
    {
        return $this->WhereHas('role', function ($query) use ($roles) {
               $query->whereIn('name', $roles);
            });
    }


}