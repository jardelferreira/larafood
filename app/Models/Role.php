<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function search($filter = null)
    {
        return  $this
            ->where('name', 'LIKE', "%$filter%")
            ->orWhere('description', 'LIKE', "%$filter%")
            ->paginate(2);
    }

    public function permissionsAvailable($filter = null)
    {
        return Permission::whereNotIn('permissions.id', function ($query) {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where('permissions.name', "lIKE", "%{$filter}%");
            })
            ->paginate();
    }
}
