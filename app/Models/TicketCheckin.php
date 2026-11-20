<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCheckin extends Model
{
    protected $fillable = ['ticket_id', 'checked_by', 'checked_in_at'];

    protected $casts = ['checked_in_at' => 'datetime'];

    public function ticket() { return $this->belongsTo(Ticket::class); }
    public function officer() { return $this->belongsTo(User::class, 'checked_by'); }
}