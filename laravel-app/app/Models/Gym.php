<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gym extends Model
{
    protected $fillable = [
        'name',
        'prefecture',
        'city',
        'address',
    ];

    /**
     * Get the users for the gym.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the equipment for the gym.
     */
    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'gym_equipment')
                    ->withPivot(['custom_name', 'notes', 'added_by_user_id'])
                    ->withTimestamps();
    }

    /**
     * Get the gym equipment records.
     */
    public function gymEquipment(): HasMany
    {
        return $this->hasMany(GymEquipment::class);
    }

    /**
     * Get the full address attribute.
     */
    public function getFullAddressAttribute(): string
    {
        return $this->prefecture . $this->city . $this->address;
    }
}
