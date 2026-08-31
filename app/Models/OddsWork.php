<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsWork extends Model
{
    protected $table = 'odds_works';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'client',
        'role',
        'year',
        'description',
        'story_content',
        'body_content',
        'cover_image',
        'showcase_video',
        'gallery_images',
        'tech_stack',
        'demo_url',
        'github_url',
        'sort_order',
        'is_featured',
        'is_active',
        'count_in_kpi',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'tech_stack' => 'array',
        'body_content' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'count_in_kpi' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Determine if the work item has structured Notion block content.
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
     * Get normalized showcase video URL for reliable local & cloud rendering.
     */
    public function getShowcaseVideoUrlAttribute(): ?string
    {
        if (empty($this->showcase_video)) {
            return null;
        }

        $src = $this->showcase_video;
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
}
