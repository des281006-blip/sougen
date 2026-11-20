<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = ['name', 'tagline', 'about', 'vision', 'mission', 'services',
        'address', 'email', 'phone', 'social_links'];

    protected $casts = ['social_links' => 'array'];
}