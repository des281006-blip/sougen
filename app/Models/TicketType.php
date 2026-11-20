<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = ['event_id', 'name', 'price', 'stock', 'sold', 'max_per_order'];

    public function event() { return $this->belongsTo(Event::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function tickets() { return $this->hasMany(Ticket::class); }

    public function getRemainingAttribute(): int
    {
        return max(0, $this->stock - $this->sold);
    }
}