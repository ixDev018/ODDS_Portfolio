<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsTestimonial extends Model
{
    protected $table = 'odds_testimonials';

    protected $fillable = [
        'name',
        'initials',
        'role',
        'company',
        'stars',
        'text',
        'avatar_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'stars' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}
