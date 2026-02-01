<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TutorialSection extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            if (empty($section->slug)) {
                $section->slug = Str::slug($section->title);
            }
        });

        static::updating(function ($section) {
            if ($section->isDirty('title') && !$section->isDirty('slug')) {
                $section->slug = Str::slug($section->title);
            }
        });
    }

    /**
     * Get the service that owns this section
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get all content blocks for this section
     */
    public function contentBlocks(): HasMany
    {
        return $this->hasMany(TutorialContentBlock::class)->orderBy('order');
    }

    /**
     * Get active content blocks
     */
    public function activeContentBlocks(): HasMany
    {
        return $this->hasMany(TutorialContentBlock::class)
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope for active sections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered sections
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('title');
    }
}
