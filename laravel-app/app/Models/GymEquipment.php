<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymEquipment extends Model
{
    protected $table = 'gym_equipment';

    protected $fillable = [
        'gym_id',
        'equipment_id',
        'custom_name',
        'notes',
        'added_by_user_id',
    ];

    /**
     * Get the gym that owns the equipment.
     */
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    /**
     * Get the equipment.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the user who added this equipment.
     */
    public function addedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }

    /**
     * Get the display name for the equipment.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->custom_name ?: $this->equipment->name;
    }
}
