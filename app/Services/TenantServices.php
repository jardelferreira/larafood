<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Str;

class TenantServices 
{
 
    public function make(Plan $plan,array $data)
    {
        $tenant = $this->storeTenant($plan,$data);
        return $this->storeUser($tenant,$data);
        
    }

    public function storeTenant($plan,$data)
    {
        return $plan->tenants()->create( [
            'plan_id' => $plan->id,
            'cnpj' => $data['cnpj'],
            'name' => $data['empresa'],
            'url' => Str::kebab($data['empresa']),
            'email' => $data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDays(7),

        ]);
    }
    public function storeUser($tenant,$data)
    {
        return $tenant->users()->create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => $data['email']
        ]);
    }
}