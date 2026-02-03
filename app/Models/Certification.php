<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Certification extends Model
{
    protected $fillable = [
        'certification_category_id',
        'code',
        'name',
        'slug',
        'description',
        'long_description',
        'level_color',
        'exam_duration',
        'questions',
        'passing_score',
        'exam_cost',
        'duration',
        'last_updated',
        'prerequisites',
        'target_audience',
        'modules',
        'skills',
        'resources',
        'faqs',
        'meta_title',
        'meta_description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'prerequisites' => 'array',
        'target_audience' => 'array',
        'modules' => 'array',
        'skills' => 'array',
        'resources' => 'array',
        'faqs' => 'array',
    ];

    /**
     * Get the category for this certification
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CertificationCategory::class, 'certification_category_id');
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certification) {
            if (empty($certification->slug)) {
                $certification->slug = Str::slug($certification->code . '-' . $certification->name);
            }
        });

        static::updating(function ($certification) {
            if ($certification->isDirty('code') || $certification->isDirty('name')) {
                if (!$certification->isDirty('slug')) {
                    $certification->slug = Str::slug($certification->code . '-' . $certification->name);
                }
            }
        });
    }

    /**
     * Scope for active certifications
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered certifications
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('code');
    }

    /**
     * Get level from category
     */
    public function getLevelAttribute()
    {
        return $this->category?->name ?? 'Unknown';
    }
}
