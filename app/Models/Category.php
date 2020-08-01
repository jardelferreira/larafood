<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TenantTrait;
    protected $fillable = [
        'tenant_id',
        'name',
        'url',
        'description'
    ];
    
    public function search($filter = null)
    {
        return  $this
        ->latest()
        ->where('description', 'LIKE', "%$filter%")
        ->orWhere('name',$filter)
        ->paginate(2);
    }
}
