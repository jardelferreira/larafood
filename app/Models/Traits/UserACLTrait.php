<?php
namespace App\Models\Traits;

use PhpParser\Node\Expr\Cast\String_;

trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant()->first();
        $plan = $tenant->plan;
        $permissions = [];
                foreach ($plan->profiles as $profile) {
                    foreach($profile->permissions as $permission){
                        array_push($permissions,$permission->name);
                    }
                }
                return $permissions;
    }
    public function hasPermission(String $permissionName ): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin()
    {
        return in_array($this->email,config('acl.admins'));
    }

    public function isTenant()
    { 
        return !in_array($this->email,config('acl.admins'));
    }
}