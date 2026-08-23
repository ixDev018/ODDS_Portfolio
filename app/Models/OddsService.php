<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsService extends Model
{
    protected $table = 'odds_services';

    protected $fillable = [
        'name',
        'description',
        'icon_svg',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
