<?php

namespace App\Livewire\Admin;

use App\Models\Apartment;
use App\Models\Rate;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Rates')]
class RateIndex extends Component
{
    use WithPagination;

    // Properties
    public string $search = '';
    public ?int $selectedApartment = null;
    public ?int $selectedWorker = null;
    
    // Form properties
    public bool $showForm = false;
    public ?int $editingRateId = null;
    public ?int $apartmentId = null;
    public ?int $workerId = null;
    public string $rateAmount = '';
    public string $currency = 'EUR';

    #[Computed]
    public function rates()
    {
        return Rate::with(['apartment', 'worker'])
            ->when($this->search, fn($query) => 
                $query->whereHas('apartment', fn($q) => 
                    $q->where('name', 'like', '%' . $this->search . '%')
                )
                ->orWhereHas('worker', fn($q) => 
                    $q->where('name', 'like', '%' . $this->search . '%')
                )
            )
            ->when($this->selectedApartment, fn($query) => 
                $query->where('apartment_id', $this->selectedApartment)
            )
            ->when($this->selectedWorker, fn($query) => 
                $query->where('worker_id', $this->selectedWorker)
            )
            ->latest()
            ->paginate(15);
    }

    #[Computed]
    public function apartments()
    {
        return Apartment::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function workers()
    {
        return User::role('worker')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function openCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function editRate(Rate $rate)
    {
        $this->editingRateId = $rate->id;
        $this->apartmentId = $rate->apartment_id;
        $this->workerId = $rate->worker_id;
        $this->rateAmount = $rate->amount;
        $this->currency = $rate->currency;
        $this->showForm = true;
    }

    public function saveRate()
    {
        $this->validate([
            'apartmentId' => 'required|exists:apartments,id',
            'workerId' => 'required|exists:users,id',
            'rateAmount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
        ]);

        if ($this->editingRateId) {
            $rate = Rate::find($this->editingRateId);
            $rate->update([
                'apartment_id' => $this->apartmentId,
                'worker_id' => $this->workerId,
                'amount' => $this->rateAmount,
                'currency' => $this->currency,
            ]);
        } else {
            Rate::create([
                'apartment_id' => $this->apartmentId,
                'worker_id' => $this->workerId,
                'amount' => $this->rateAmount,
                'currency' => $this->currency,
            ]);
        }

        $this->resetForm();
        $this->showForm = false;
        $this->resetPage();
    }

    public function deleteRate(Rate $rate)
    {
        $rate->delete();
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->editingRateId = null;
        $this->apartmentId = null;
        $this->workerId = null;
        $this->rateAmount = '';
        $this->currency = 'EUR';
    }

    public function render()
    {
        return view('livewire.admin.rate-index');
    }
}
