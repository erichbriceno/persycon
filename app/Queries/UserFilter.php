<?php


namespace App\Queries;


use App\Utils\Sortable;
use Carbon\Carbon;
use App\Rules\SortableColumn;

class UserFilter extends QueryFilter
{
    protected $aliases = [
        'date' => 'created_at',
        'cedule' => 'numberced'
    ];

    public function rules(): array
    {
        return [
            'search' => 'filled',
            'state' => 'in:active,inactive',
            'management' => 'exists:managements,name',
            'roles' => 'array|exists:roles,name',
            'from' => 'date_format:d/m/Y',
            'to' => 'date_format:d/m/Y',
            'order' => [new SortableColumn(['id', 'cedule', 'names', 'email', 'date'])],
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
        [$column, $direction] = Sortable::info($value);

            return $query->orderBy($this->getColumnName($column), $direction);
    }

    protected function getColumnName($alias)
    {
        return $this->aliases[$alias] ?? $alias;
    }

}