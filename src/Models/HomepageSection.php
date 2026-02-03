<?php

namespace Tabour\Homepage\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    protected $table = 'homepage_sections';

    protected $fillable = [
        'type',   
        'title',
        'subtitle',
        'image_path',
        'content',    
        'order',
        'is_visible',
    ];

    protected $casts = [
        'content'    => 'array',
        'is_visible' => 'bool',
    ];

    public function scopeVisible($q) { return $q->where('is_visible', true); }
    public function scopeOrdered($q) { return $q->orderBy('order'); }
    public function scopeType($q, string $type) { return $q->where('type', $type); }

    public function isHero(): bool         { return $this->type === 'hero'; }
    public function isFeatureGrid(): bool  { return $this->type === 'feature_grid'; }
    public function isCta(): bool          { return $this->type === 'cta'; }
    public function isContactInfo(): bool  { return $this->type === 'contact_info'; }

    public function contact(): array
    {
        return $this->content['contact'] ?? [];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (is_null($model->order)) {
                $max = static::max('order');
                $model->order = is_null($max) ? 0 : ((int) $max + 1);
            }
        });
    }
}
