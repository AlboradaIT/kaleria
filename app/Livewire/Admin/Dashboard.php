<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\WorkOrder;
use App\Models\Apartment;
use App\Models\User;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_apartments' => Apartment::count(),
            'pending_orders' => WorkOrder::where('status', 'pending')->count(),
            'active_workers' => User::role('worker')->count(),
            'completed_today' => WorkOrder::where('status', 'completed')
                ->whereDate('actual_end', today())
                ->count(),
        ];

        $recent_orders = WorkOrder::with(['apartment', 'assignedTo'])
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', compact('stats', 'recent_orders'));
    }
}
