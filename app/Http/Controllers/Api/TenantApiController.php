<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantServices;
use Illuminate\Http\Request;

class TenantApiController extends Controller
{
    protected $tenantServices;
    public function __construct(TenantServices $tenantServices)
    {
        $this->tenantServices = $tenantServices;
    }

    public function index()
    {
        return TenantResource::collection($this->tenantServices->getAllTenants());
    }
}
