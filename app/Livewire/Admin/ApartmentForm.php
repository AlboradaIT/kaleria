<?php

namespace App\Livewire\Admin;

use App\Models\Apartment;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class ApartmentForm extends Component
{
    // Public properties
    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|string|max:1000')]
    public string $address = '';

    #[Rule('nullable|string|max:255')]
    public string $city = '';

    #[Rule('nullable|string|max:255')]
    public string $postal_code = '';

    #[Rule('nullable|string|max:255')]
    public string $country = '';

    #[Rule('nullable|integer|min:1|max:20')]
    public ?int $max_guests = null;

    #[Rule('nullable|integer|min:1|max:10')]
    public ?int $bedrooms = null;

    #[Rule('nullable|integer|min:1|max:10')]
    public ?int $bathrooms = null;

    #[Rule('nullable|string|max:255')]
    public string $external_id = '';

    #[Rule('boolean')]
    public bool $is_active = true;

    #[Rule('nullable|string|max:1000')]
    public string $description = '';

    // Component state
    public ?Apartment $apartment = null;
    public bool $isEditing = false;

    /**
     * Mount component with optional apartment for editing
     */
    public function mount(?Apartment $apartment = null): void
    {
        if ($apartment) {
            $this->apartment = $apartment;
            $this->isEditing = true;
            $this->loadApartmentData();
        }
    }

    /**
     * Load apartment data into form properties
     */
    private function loadApartmentData(): void
    {
        $this->name = $this->apartment->name;
        $this->address = $this->apartment->address;
        $this->city = $this->apartment->city ?? '';
        $this->postal_code = $this->apartment->postal_code ?? '';
        $this->country = $this->apartment->country ?? '';
        $this->max_guests = $this->apartment->max_guests;
        $this->bedrooms = $this->apartment->bedrooms;
        $this->bathrooms = $this->apartment->bathrooms;
        $this->external_id = $this->apartment->external_id ?? '';
        $this->is_active = $this->apartment->is_active;
        $this->description = $this->apartment->description ?? '';
    }

    /**
     * Save apartment (create or update)
     */
    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city ?: null,
            'postal_code' => $this->postal_code ?: null,
            'country' => $this->country ?: null,
            'max_guests' => $this->max_guests,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'external_id' => $this->external_id ?: null,
            'is_active' => $this->is_active,
            'description' => $this->description ?: null,
        ];

        if ($this->isEditing) {
            $this->apartment->update($data);
            $message = 'Apartment updated successfully!';
        } else {
            Apartment::create($data);
            $message = 'Apartment created successfully!';
        }

        session()->flash('success', $message);
        
        $this->dispatch('apartment-saved');
        $this->closeModal();
    }

    /**
     * Close modal and reset form
     */
    public function closeModal(): void
    {
        $this->dispatch('closeModal');
        $this->resetForm();
    }

    /**
     * Reset form properties
     */
    public function resetForm(): void
    {
        $this->name = '';
        $this->address = '';
        $this->city = '';
        $this->postal_code = '';
        $this->country = '';
        $this->max_guests = null;
        $this->bedrooms = null;
        $this->bathrooms = null;
        $this->external_id = '';
        $this->is_active = true;
        $this->description = '';
        $this->apartment = null;
        $this->isEditing = false;
    }

    /**
     * Get modal title based on mode
     */
    public function getModalTitle(): string
    {
        return $this->isEditing ? 'Edit Apartment' : 'Add New Apartment';
    }

    public function render()
    {
        return view('livewire.admin.apartment-form');
    }
}
