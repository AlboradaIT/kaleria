<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stay extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'apartment_id',
        'external_id',
        'start_date',
        'end_date',
        'actual_check_in',
        'actual_check_out',
        'guests_count',
        'status',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'actual_check_in' => 'datetime',
            'actual_check_out' => 'datetime',
            'metadata' => 'array',
        ];
    }

    // Relationships
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCurrent($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    // Helper methods
    public function isActive(): bool
    {
        return $this->status === 'active' && 
               $this->start_date <= now() && 
               $this->end_date >= now();
    }

    public function hasEnded(): bool
    {
        return $this->end_date < now() || $this->status === 'completed';
    }

    public function getAvailableWindowForCleaning()
    {
        // Return the time window between this stay's end and next booking start
        $nextBooking = $this->apartment->bookings()
            ->where('check_in_date', '>', $this->end_date)
            ->orderBy('check_in_date')
            ->first();

        return [
            'start' => $this->end_date->addHours(1), // 1 hour after checkout
            'end' => $nextBooking ? $nextBooking->check_in_date->subHours(2) : null, // 2 hours before next checkin
        ];
    }
}
