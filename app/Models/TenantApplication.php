<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantApplication extends Model
{
    protected $fillable = ['tenant_id', 'event_id', 'booth_category', 'booth_qty',
        'unit_price', 'total_fee', 'status', 'admin_note'];

    public function tenant() { return $this->belongsTo(Tenant::class); }
    public function event() { return $this->belongsTo(Event::class); }
    public function payments() { return $this->hasMany(TenantPayment::class); }
}