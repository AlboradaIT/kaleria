<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'worker_id',
        'price',
        'currency',
        'notes',
        'effective_from',
        'effective_until',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'effective_from' => 'datetime',
            'effective_until' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        return $query->where('effective_from', '<=', now())
            ->where(function ($query) {
                $query->whereNull('effective_until')
                    ->orWhere('effective_until', '>=', now());
            });
    }

    // Helper methods
    public function isCurrentlyActive(): bool
    {
        return $this->is_active 
            && $this->effective_from <= now()
            && ($this->effective_until === null || $this->effective_until >= now());
    }
}
