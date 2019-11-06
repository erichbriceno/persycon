<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'names', 'surnames', 'email', 'role_id', 'management_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function management()
    {
        return $this->belongsTo(Management::class)->withDefault([
            'name' => 'Unassigned',
        ]);
    }

    public function scopeSearch($query, $search)
    {
        if( empty($search)) {
            return;
        }

        $query->whereRaw('CONCAT(names, " ", surnames) like ?', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
    }

    public function scopeByState($query, $state)
    {
        if($state == 'active') {
            return $query->where('active', true);
        }
        if($state == 'inactive') {
            return $query->where('active', false);
        }
    }

    public function scopeByManagement($query, $management)
    {
        if(!empty($management)) {
            if($management === 'Unassigned') {
                $query->where('management_id', null);
            }else {
                $query->whereHas('management', function ($query) use ($management) {
                    $query->where('name', $management);
                });
            }
        }
    }
    
    public function getNameAttribute()
    {
        return "{$this->names} {$this->surnames}";
    }

}
