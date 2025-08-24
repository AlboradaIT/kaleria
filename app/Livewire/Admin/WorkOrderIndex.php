<?php

namespace App\Livewire\Admin;

use App\Models\WorkOrder;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class WorkOrderIndex extends Component
{
    use WithPagination;

    public string $filter = '';

    public function mount(): void
    {
        $this->filter = request('filter', '');
    }

    #[Computed]
    public function workOrders()
    {
        return WorkOrder::query()
            ->with(['apartment', 'assignedTo'])
            ->when($this->filter, fn($query) => 
                $query->where('status', $this->filter)
            )
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.work-order-index');
    }
}
