<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'apartment_id',
        'guest_name',
        'guest_email',
        'check_in',
        'check_out',
        'guests_count',
        'status',
        'metadata',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'guests_count' => 'integer',
        'metadata' => 'array',
    ];

    /**
     * Get the apartment that owns the booking.
     */
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    /**
     * Get the stays for this booking.
     */
    public function stays(): HasMany
    {
        return $this->hasMany(Stay::class);
    }

    /**
     * Get the work orders related to this booking.
     */
    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    /**
     * Scope to get active bookings.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope to get upcoming bookings.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('check_in', '>', now());
    }

    /**
     * Scope to get current bookings.
     */
    public function scopeCurrent($query)
    {
        return $query->where('check_in', '<=', now())
                    ->where('check_out', '>', now());
    }

    /**
     * Check if booking is currently active.
     */
    public function isActive(): bool
    {
        return $this->check_in <= now() && $this->check_out > now();
    }

    /**
     * Get the duration of the booking in days.
     */
    public function getDurationAttribute(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    /**
     * Get formatted guest count.
     */
    public function getFormattedGuestsAttribute(): string
    {
        return $this->guests_count . ' ' . ($this->guests_count === 1 ? 'guest' : 'guests');
    }
}
