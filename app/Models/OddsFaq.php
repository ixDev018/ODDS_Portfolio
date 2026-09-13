<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsFaq extends Model
{
    protected $table = 'odds_faqs';

    protected $fillable = [
        'question',
        'category',
        'answer',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}
