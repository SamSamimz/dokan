<?php

namespace App\Livewire;

use App\Livewire\Traits\handleLogout;
use Livewire\Component;

class Sidebar extends Component
{
    use handleLogout;

    public function render()
    {
        return view('partials.sidebar');
    }
}
