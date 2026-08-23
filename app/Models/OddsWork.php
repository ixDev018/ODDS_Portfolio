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
        'gallery_images',
        'tech_stack',
        'demo_url',
        'github_url',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'tech_stack' => 'array',
        'body_content' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
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
            if (in_array($type, ['image', 'video'])) {
                return empty($block['src'] ?? '');
            }
            return empty($block['content'] ?? '') && empty($block['src'] ?? '');
        })->isNotEmpty();
    }
}
