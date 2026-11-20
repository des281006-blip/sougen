<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'reference', 'method', 'mode', 'amount', 'status',
        'paid_at', 'expires_at', 'raw_payload'];

    protected $casts = [
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
        'raw_payload' => 'array',
    ];

    public function order() { return $this->belongsTo(Order::class); }
}