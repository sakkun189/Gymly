<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'youtube_url',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Get the gyms that have this equipment.
     */
    public function gyms(): BelongsToMany
    {
        return $this->belongsToMany(Gym::class, 'gym_equipment')
                    ->withPivot(['custom_name', 'notes', 'added_by_user_id'])
                    ->withTimestamps();
    }

    /**
     * Get category label in Japanese.
     */
    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'chest' => '胸',
            'back' => '背中',
            'legs' => '脚',
            'arms' => '腕',
            'shoulders' => '肩',
            'abs' => '腹',
            'cardio' => '有酸素',
            'other' => 'その他',
            default => $this->category,
        };
    }

    /**
     * Scope to get equipment by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get default equipment.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
