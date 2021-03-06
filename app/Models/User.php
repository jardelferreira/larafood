<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tenant_id'
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
    public function search($filter = null)
    {
        return  $this
        ->tenantUser()
        ->latest()
        ->where('name', 'LIKE', "%$filter%")
        ->orWhere('email', 'LIKE', "%$filter%")
        ->paginate(2);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

      /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query)
    {
        return $query->where('tenant_id',auth()->user()->tenant_id);
    }

    public function isSuper()
    {
        return in_array($this->email,config('acl.admins'));
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function rolesAvailable($filter = null)
    {
        return Role::whereNotIn('roles.id', function ($query) {
            $query->select('role_user.role_id');
            $query->from('role_user');
            $query->whereRaw("role_user.role_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('roles.name', "lIKE", "%{$filter}%");
            })
            ->paginate();
    }
}
