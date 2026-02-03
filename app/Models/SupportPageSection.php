<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportPageSection extends Model
{
    protected $fillable = [
        'section_type',
        'title',
        'subtitle',
        'description',
        'icon',
        'link_url',
        'link_text',
        'color_scheme',
        'data',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active sections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order sections
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Scope to get sections by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('section_type', $type);
    }
}
