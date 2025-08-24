<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class WorkerIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function workers()
    {
        return User::role('worker')
            ->withCount('workOrders')
            ->orderBy('name')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.worker-index');
    }
}
