<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'url', 'description','price'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function search($filter = null)
    {
        return  $this
        ->where('name', 'LIKE', "%$filter%")
        ->orWhere('description', 'LIKE', "%$filter%")
        ->paginate(2);
    }
}

