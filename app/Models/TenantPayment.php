<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPayment extends Model
{
    protected $fillable = ['tenant_application_id', 'reference', 'method', 'mode', 'amount',
        'status', 'paid_at', 'expires_at', 'raw_payload'];

    protected $casts = [
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
        'raw_payload' => 'array',
    ];

    public function application() { return $this->belongsTo(TenantApplication::class, 'tenant_application_id'); }
}