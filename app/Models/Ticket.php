<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['order_id', 'order_item_id', 'ticket_type_id', 'event_id',
        'ticket_code', 'holder_name', 'status'];

    public function order() { return $this->belongsTo(Order::class); }
    public function orderItem() { return $this->belongsTo(OrderItem::class); }
    public function ticketType() { return $this->belongsTo(TicketType::class); }
    public function event() { return $this->belongsTo(Event::class); }
    public function checkin() { return $this->hasOne(TicketCheckin::class); }
}