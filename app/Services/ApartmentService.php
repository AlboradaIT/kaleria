<?php

namespace App\Services;

use App\Models\Apartment;
use Illuminate\Pagination\LengthAwarePaginator;

class ApartmentService
{
    /**
     * Get paginated apartments with search and filters
     */
    public function getPaginatedApartments(
        ?string $search = null,
        bool $showInactive = false,
        int $perPage = 10
    ): LengthAwarePaginator {
        return Apartment::query()
            ->when($search, fn($query) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
            )
            ->when(!$showInactive, fn($query) => 
                $query->where('is_active', true)
            )
            ->withCount(['workOrders', 'bookings'])
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Create a new apartment
     */
    public function createApartment(array $data): Apartment
    {
        return Apartment::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? true,
            'metadata' => $this->buildMetadata($data),
        ]);
    }

    /**
     * Update an existing apartment
     */
    public function updateApartment(Apartment $apartment, array $data): Apartment
    {
        $apartment->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? true,
            'metadata' => $this->buildMetadata($data),
        ]);

        return $apartment->fresh();
    }

    /**
     * Toggle apartment active status
     */
    public function toggleStatus(Apartment $apartment): Apartment
    {
        $apartment->update(['is_active' => !$apartment->is_active]);
        return $apartment->fresh();
    }

    /**
     * Delete apartment
     */
    public function deleteApartment(Apartment $apartment): bool
    {
        return $apartment->delete();
    }

    /**
     * Build metadata from extra fields
     */
    private function buildMetadata(array $data): ?array
    {
        $metadata = [];

        // Store additional fields in metadata if provided
        $metadataFields = ['address', 'city', 'postal_code', 'country', 'max_guests', 'bedrooms', 'bathrooms', 'external_id'];
        
        foreach ($metadataFields as $field) {
            if (!empty($data[$field])) {
                $metadata[$field] = $data[$field];
            }
        }

        return empty($metadata) ? null : $metadata;
    }
}
