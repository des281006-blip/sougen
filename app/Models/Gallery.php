<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'image_path', 'caption', 'event_id'];

    public function event() { return $this->belongsTo(Event::class); }
}