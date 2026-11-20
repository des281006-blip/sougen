<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['user_id', 'business_name', 'contact_name', 'email', 'phone'];

    public function user() { return $this->belongsTo(User::class); }
    public function applications() { return $this->hasMany(TenantApplication::class); }
}