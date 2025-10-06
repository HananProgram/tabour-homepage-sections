<?php

namespace Tabour\Homepage\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    protected $table = 'homepage_sections';

    protected $fillable = [
        'type',        // hero, feature_grid, cta
        'title',
        'subtitle',
        'image_path',
        'content',     // JSON
        'order',
        'is_visible',
    ];

    protected $casts = [
        'content'    => 'array',
        'is_visible' => 'bool',
    ];
}
