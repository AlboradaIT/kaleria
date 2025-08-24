<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WorkOrder extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'apartment_id',
        'stay_id',
        'assigned_to',
        'title',
        'description',
        'scheduled_start',
        'scheduled_end',
        'actual_start',
        'actual_end',
        'price',
        'status',
        'worker_notes',
        'admin_notes',
        'priority',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_start' => 'datetime',
            'scheduled_end' => 'datetime',
            'actual_start' => 'datetime',
            'actual_end' => 'datetime',
            'price' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    // Relationships
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function stay(): BelongsTo
    {
        return $this->belongsTo(Stay::class);
    }

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('completion_photos')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeForWorker($query, $workerId)
    {
        return $query->where('assigned_to', $workerId);
    }

    // Helper methods
    public function canBeAccepted(): bool
    {
        return in_array($this->status, ['pending', 'assigned']);
    }

    public function canBeCompleted(): bool
    {
        return in_array($this->status, ['accepted', 'in_progress']);
    }

    public function isOverdue(): bool
    {
        return $this->scheduled_end < now() && !in_array($this->status, ['completed', 'cancelled']);
    }
}
