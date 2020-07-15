<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    public function search($filter = null)
    {
        return  $this
        ->where('name', 'LIKE', "%$filter%")
        ->orWhere('description', 'LIKE', "%$filter%")
        ->paginate(2);
    }
}
