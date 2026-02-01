<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutorialContentBlock extends Model
{
    protected $fillable = [
        'tutorial_section_id',
        'type',
        'content',
        'code_language',
        'image_path',
        'image_alt',
        'image_caption',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the section that owns this content block
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(TutorialSection::class, 'tutorial_section_id');
    }

    /**
     * Scope for active blocks
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered blocks
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Scope for content type blocks
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
