<?php


namespace App\Queries;


use Carbon\Carbon;
use Illuminate\Support\Str;

class UserFilter extends QueryFilter
{

    public function rules(): array
    {
        return [
            'search' => 'filled',
            'state' => 'in:active,inactive',
            'management' => 'exists:managements,name',
            'roles' => 'array|exists:roles,name',
            'from' => 'date_format:d/m/Y',
            'to' => 'date_format:d/m/Y',
            'order' => 'in:id,names,email,created_at,id-desc,names-desc,email-desc,created_at-desc',
        ];
    }

    public function filterBySearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->whereRaw('CONCAT(names, " ", surnames) like ?', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
        });
    }

    public function filterByState($query, $state)
    {
        return $query->where('active', $state == 'active');
    }

    public function filterByManagement($query, $management)
    {
        if(!empty($management)) {
            if($management === 'Unassigned') {
                $query->where('management_id', null);
            }else {
                $query->whereHas('management', function ($q) use ($management) {
                    $q->where('name', $management);
                });
            }
        }
        return $query;
    }

    public function filterByRoles($query, array $roles)
    {
        return $query->WhereHas('role', function ($q) use ($roles) {
            $q->whereIn('name', $roles);
        });
    }

    public function filterByFrom($query, $date)
    {
        $date = Carbon::createFromFormat('d/m/Y', $date);

        return $query->whereDate('created_at', '>=', $date);
    }

    public function filterByTo($query, $date)
    {
        $date = Carbon::createFromFormat('d/m/Y', $date);

        return $query->whereDate('created_at', '<=', $date);
    }

    public function filterByOrder($query, $value)
    {
        if (Str::endsWith($value, '-desc')) {
            return $query->orderByDesc(Str::substr($value, 0,-5));
        } else {
            return $query->orderBy($value);
        }
    }

}