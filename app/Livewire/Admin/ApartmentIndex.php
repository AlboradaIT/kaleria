<?php

namespace App\Livewire\Admin;

use App\Models\Apartment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Apartments')]
class ApartmentIndex extends Component
{
    use WithPagination;

    // Properties
    public string $search = '';
    public bool $showInactive = false;

    // Lifecycle methods
    public function mount()
    {
        $this->resetPage();
    }

    #[Computed]
    public function apartments()
    {
        return Apartment::query()
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('external_id', 'like', '%' . $this->search . '%')
            )
            ->when(!$this->showInactive, fn($query) => 
                $query->where('is_active', true)
            )
            ->withCount(['workOrders', 'bookings'])
            ->orderBy('name')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.apartment-index');
    }

    // Actions
    #[On('apartmentCreated')]
    #[On('apartmentUpdated')]
    public function refreshComponent()
    {
        // This method will be called when these events are dispatched
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedShowInactive()
    {
        $this->resetPage();
    }

    public function toggleStatus(Apartment $apartment)
    {
        $apartment->update([
            'is_active' => !$apartment->is_active
        ]);

        $this->dispatch('apartmentUpdated');
    }

    /**
     * Listen for apartment saved event to refresh list
     */
    #[On('apartment-saved')]
    public function refreshApartments(): void
    {
        // Reset to first page in case we're on a higher page
        $this->resetPage();
    }

    /**
     * Delete apartment
     */
    public function deleteApartment(Apartment $apartment): void
    {
        $apartment->delete();
        session()->flash('success', 'Apartment deleted successfully!');
    }
}
