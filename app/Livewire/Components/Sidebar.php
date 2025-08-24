<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Sidebar extends Component
{
    #[Computed]
    public function navigationLinks()
    {
        $user = auth()->user();
        
        if ($user && $user->hasRole('admin')) {
            return [
                [
                    'href' => route('admin.dashboard'),
                    'label' => __('Dashboard'),
                    'icon' => 'heroicon-o-home',
                    'active' => request()->routeIs('admin.dashboard*'),
                ],
                [
                    'href' => route('admin.work-orders'),
                    'label' => __('Work Orders'),
                    'icon' => 'heroicon-o-clipboard-document-list',
                    'active' => request()->routeIs('admin.work-orders*'),
                ],
                [
                    'href' => route('admin.apartments'),
                    'label' => __('Apartments'),
                    'icon' => 'heroicon-o-building-office',
                    'active' => request()->routeIs('admin.apartments*'),
                ],
                [
                    'href' => route('admin.workers'),
                    'label' => __('Workers'),
                    'icon' => 'heroicon-o-users',
                    'active' => request()->routeIs('admin.workers*'),
                ],
                [
                    'href' => route('admin.rates'),
                    'label' => __('Rates'),
                    'icon' => 'heroicon-o-currency-euro',
                    'active' => request()->routeIs('admin.rates*'),
                ],
                [
                    'href' => '#',
                    'label' => __('Reports'),
                    'icon' => 'heroicon-o-chart-bar',
                    'active' => request()->routeIs('admin.reports*'),
                ],
            ];
        }
        
        // Default empty array for non-admin users
        return [];
    }
    
    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
