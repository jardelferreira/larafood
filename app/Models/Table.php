<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use TenantTrait;
    protected $fillable = [
        'tenant_id',
        'identify',
        'description'
    ];
    
    public function search($filter = null)
    {
        return  $this
        ->latest()
        ->where('description', 'LIKE', "%$filter%")
        ->orWhere('identify',$filter)
        ->paginate(2);
    }
}
