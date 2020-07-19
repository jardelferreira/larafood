<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'plan-id','cnpj','name','url','email'
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
