<?php
namespace App\Models\Traits;

use App\Models\Tenant;
use PhpParser\Node\Expr\Cast\String_;

trait UserACLTrait
{
    public function permissionsUser()
    {
       // dd($this->permissionsPlan());
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();
        return array_intersect($permissionsPlan,$permissionsRole);
    }

    public function permissionsPlan(): array
    {
        
       // $tenant = $this->tenant()->first();
        //$plan = $tenant->plan;
        // busca metodo plan em Tenant depois profiles em Plan e depois permissions em Profiles
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan = $tenant->plan;
        $permissions = [];
                foreach ($plan->profiles as $profile) {
                    foreach($profile->permissions as $permission){
                        array_push($permissions,$permission->name);
                    }
                }
                return $permissions;
    }

    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();
        $permissions = [];

        foreach ($roles as $role) {
            foreach($role->permissions as $permission){
                array_push($permissions,$permission->name);
            }
        }
        return $permissions;
    }

    public function hasPermission(String $permissionName ): bool
    {
       //dd($this->permissionsUser());
       // dd($permissions);
        return in_array($permissionName,$this->permissionsUser());
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