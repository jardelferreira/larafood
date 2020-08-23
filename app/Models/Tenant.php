<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'plan_id','cnpj','name','url','email','subscription','expires_at','logo'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function search($filter = null)
    {
        return  $this
        ->latest()
        ->where('name', 'LIKE', "%$filter%")
        ->orWhere('cnpj',$filter)
        ->paginate(2);
    }

}
