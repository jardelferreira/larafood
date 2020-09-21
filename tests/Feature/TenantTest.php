<?php

namespace Tests\Feature;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllTenants()
    {
        $response = $this->getJson('/api/v1/tenants');
        //$response->dump();
        $response->assertStatus(200);
    }
    /**
     * A Error Get Tenant.
     *
     * @return void
     */
    public function testErrorGetTenant()
    {
       $tenant = "fake_value";
        $response = $this->getJson("/api/v1/tenants/fake_value");
        $response->assertStatus(404);
    }
    public function testGetTenantByUuid()
    {
        $tenant  = factory(Tenant::class);
        $response = $this->getJson("api/v1/tenants/{$tenant->uuid}");
        $response->assertStatus(200);
    }
}
