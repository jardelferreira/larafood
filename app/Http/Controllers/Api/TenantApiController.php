<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use App\Services\TenantServices;
use Illuminate\Http\Request;

class TenantApiController extends Controller
{
    protected $tenantServices;
    public function __construct(TenantServices $tenantServices)
    {
        $this->tenantServices = $tenantServices;
    }

    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page',15);
        $tenants = $this->tenantServices->getAllTenants($per_page);
        return TenantResource::collection($tenants);
    }
    public function show(string $uuid)
    {
        if (!$tenant = $this->tenantServices->getTenantByUuid($uuid)) {
            return response()->json(['message' => 'Not Found'],404);
        }
        return new TenantResource($tenant);
    }
}
