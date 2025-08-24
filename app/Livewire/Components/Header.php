<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Header extends Component
{
    public $title = 'Dashboard';
    public $subtitle = '';
    
    public function mount($title = 'Dashboard', $subtitle = '')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }
    
    public function render()
    {
        return view('livewire.components.header');
    }
}
