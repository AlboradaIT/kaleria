<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'external_id',
        'description',
        'is_active',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * Get the bookings for this apartment.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the stays for this apartment.
     */
    public function stays(): HasMany
    {
        return $this->hasMany(Stay::class);
    }

    /**
     * Get the work orders for this apartment.
     */
    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    /**
     * Get the rates for this apartment.
     */
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    /**
     * Scope for active apartments only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessors for metadata fields
     */
    public function getAddressAttribute(): ?string
    {
        return $this->metadata['address'] ?? null;
    }

    public function getCityAttribute(): ?string
    {
        return $this->metadata['city'] ?? null;
    }

    public function getMaxGuestsAttribute(): ?int
    {
        return $this->metadata['max_guests'] ?? null;
    }

    public function getBedroomsAttribute(): ?int
    {
        return $this->metadata['bedrooms'] ?? null;
    }

    public function getBathroomsAttribute(): ?int
    {
        return $this->metadata['bathrooms'] ?? null;
    }
}
