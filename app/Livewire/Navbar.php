<?php

namespace App\Livewire;

use App\Livewire\Traits\handleLogout;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Navbar extends Component
{
    use handleLogout;
    public function changeLang($lang) {
        Cache::forget('lang');
        Cache::put('lang',$lang);
        $this->dispatch('reload-page');
    }


    public function render()
    {
        return view('partials.navbar');
    }
}
