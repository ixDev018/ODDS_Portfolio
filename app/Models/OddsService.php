<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsService extends Model
{
    protected $table = 'odds_services';

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'body_content',
        'icon_svg',
        'cover_image',
        'features',
        'action_btn_text',
        'action_btn_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'body_content' => 'array',
        'features' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Determine if the service has structured Notion block content.
     */
    public function hasBodyContent(): bool
    {
        if (empty($this->body_content)) {
            return false;
        }

        $blocks = is_array($this->body_content) ? $this->body_content : json_decode($this->body_content, true);
        if (!is_array($blocks)) {
            return false;
        }

        return collect($blocks)->reject(function ($block) {
            $type = $block['type'] ?? '';
            if (in_array($type, ['paragraph', 'heading2', 'heading3', 'quote', 'callout', 'code'])) {
                $text = trim(str_replace('&nbsp;', '', strip_tags($block['content'] ?? '')));
                return empty($text);
            }
            return empty($block['content'] ?? '') && empty($block['src'] ?? '');
        })->isNotEmpty();
    }

    /**
     * Get normalized cover image URL for reliable local & cloud rendering.
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        if (empty($this->cover_image)) {
            return null;
        }

        $src = $this->cover_image;
        if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) {
            if (preg_match('#https?://(?:localhost|127\.0\.0\.1|0\.0\.0\.0)(?::\d+)?(/storage/.*)#', $src, $m)) {
                return $m[1];
            }
            return $src;
        }

        if (str_starts_with($src, '/storage') || str_starts_with($src, 'storage/')) {
            return '/' . ltrim($src, '/');
        }

        return asset($src);
    }

    /**
     * Get a single-line clean display name.
     */
    public function getCleanNameAttribute(): string
    {
        return trim(str_replace(["\r\n", "\r", "\n"], ' ', $this->name ?? ''));
    }
}
