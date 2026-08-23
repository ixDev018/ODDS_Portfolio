<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsInquiry extends Model
{
    protected $table = 'odds_inquiries';

    protected $fillable = [
        'name',
        'email',
        'company',
        'service_needed',
        'message',
        'is_read',
        'ip_address',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
