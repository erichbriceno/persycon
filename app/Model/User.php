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
        'first_name', 'last_name', 'email', 'role_id', 'management_id', 'password'
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
        
        $query->where('first_name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhereHas('management', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}