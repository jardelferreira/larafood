<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'url', 'description','price'];

    public function getRouteKeyName($key = 'url')
    {
        return $key;
    }

    public function profiles()  
    {
        return  $this->belongsToMany(Profile::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }
    public function search($filter = null)
    {
        return  $this
        ->where('name', 'LIKE', "%$filter%")
        ->orWhere('description', 'LIKE', "%$filter%")
        ->paginate(2);
    }
    public function profilesAvailable($filter = null)
    {
        return Profile::whereNotIn('profiles.id', function($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('profiles.name',"lIKE","%{$filter}%");
        })
            ->paginate();
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}

