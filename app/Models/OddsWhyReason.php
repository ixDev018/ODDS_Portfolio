<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsWhyReason extends Model
{
    protected $table = 'odds_why_reasons';

    protected $fillable = [
        'title',
        'text',
        'icon_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}
