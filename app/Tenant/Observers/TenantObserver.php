<?php
namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * Handle the Model "created" event.
     *
     * @param  \App\Models\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);
        $model->tenant_id = $managerTenant->getTenantIdentify();
    }
}