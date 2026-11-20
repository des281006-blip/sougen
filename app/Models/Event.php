<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'poster_path', 'starts_at', 'ends_at',
        'location', 'is_free', 'status', 'sales_start_at', 'sales_end_at'];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'sales_start_at' => 'datetime',
        'sales_end_at' => 'datetime',
        'is_free' => 'boolean',
    ];

    public function ticketTypes() { return $this->hasMany(TicketType::class); }
    public function orders() { return $this->hasMany(Order::class); }
    public function tickets() { return $this->hasMany(Ticket::class); }
    public function tenantApplications() { return $this->hasMany(TenantApplication::class); }
    public function galleries() { return $this->hasMany(Gallery::class); }

    public function scopeUpcoming($q) { return $q->whereIn('status', ['upcoming', 'ongoing'])->orderBy('starts_at'); }
    public function scopeFinished($q) { return $q->where('status', 'finished')->orderByDesc('starts_at'); }

    /** Apakah penjualan tiket sedang dibuka? */
    public function isSalesOpen(): bool
    {
        if ($this->status === 'finished') return false;
        $now = now();
        if ($this->sales_start_at && $now->lt($this->sales_start_at)) return false;
        if ($this->sales_end_at && $now->gt($this->sales_end_at)) return false;
        return true;
    }
}