<?php

namespace App\Livewire\Worker;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.worker')]
class MyOrders extends Component
{
    public function render()
    {
        return view('livewire.worker.my-orders');
    }
}
