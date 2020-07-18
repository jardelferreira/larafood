<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    public function search($filter = null)
    {
        return  $this
        ->where('name', 'LIKE', "%$filter%")
        ->orWhere('description', 'LIKE', "%$filter%")
        ->paginate(2);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionsAvailable($filter = null)
    {
        return Permission::whereNotIn('permissions.id', function($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('permissions.name',"lIKE","%{$filter}%");
        })
            ->paginate();
    }

    public function plansAvailable($filter = null)
    {
        return Plan::whereNotIn('plans.id', function($query){
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('plans.name',"lIKE","%{$filter}%");
        })
            ->paginate();
    }
}
