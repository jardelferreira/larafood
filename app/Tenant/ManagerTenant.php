<?php
namespace App\Tenant;

use App\Models\Tenant;
use phpDocumentor\Reflection\Types\Boolean;

class ManagerTenant
{
    public function getTenantIdentify() :int
    {
        return auth()->check() ? auth()->user()->tenant_id: "";
    }

    public function getTenant() :Tenant
    {
        return auth()->check() ? auth()->user()->tenant: "";
    }

    public function isAdmin() :bool
    {
        return in_array(auth()->user()->email,config('tenant.admin'));
    }
}