<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'name',
        'slug',
        'description',
        'icon_identifier',
        'icon_url',
        'video_url',
        'video_thumbnail',
        'video_duration',
        'difficulty',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected $appends = ['tutorials_count'];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('name') && !$service->isDirty('slug')) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    /**
     * Get the category that owns the service
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    /**
     * Get the resources for the service
     */
    public function resources(): HasMany
    {
        return $this->hasMany(ServiceResource::class);
    }

    /**
     * Get active resources
     */
    public function activeResources(): HasMany
    {
        return $this->hasMany(ServiceResource::class)->where('is_active', true)->orderBy('order');
    }

    /**
     * Get tutorial sections for this service
     */
    public function tutorialSections(): HasMany
    {
        return $this->hasMany(TutorialSection::class)->orderBy('order');
    }

    /**
     * Get active tutorial sections
     */
    public function activeTutorialSections(): HasMany
    {
        return $this->hasMany(TutorialSection::class)
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope for active services
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered services
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    /**
     * Get tutorials count attribute
     */
    public function getTutorialsCountAttribute()
    {
        return $this->resources()->where('is_active', true)->count();
    }
}
