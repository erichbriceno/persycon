<?php

namespace App\Queries;

use App\Model\Login;
use Illuminate\Database\Eloquent\Builder;

class UserQuery extends Builder
{


    public function filterBy(QueryFilter $filters, array $data)
    {
        return $filters->applyTo($this, $data);
    }

    public function onlyTrashedIf($trashed)
    {
        if ($trashed) {
            $this->onlyTrashed();
        }
        return $this;
    }

    public function withLastLogin()
    {
        $subselect = Login::select('logins.created_at')
            ->whereColumn('user_id', 'users.id')
            ->latest() //orderByDesc('created_at')
            ->limit(1);

        $this->addSelect([
            'last_login_at' => $subselect,
        ]);

        return $this;
    }

}