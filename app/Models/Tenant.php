<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'plan_id','cnpj','name','url','email','subscription','expires_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
