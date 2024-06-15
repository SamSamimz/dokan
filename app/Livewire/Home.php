<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
class Home extends Component
{
    public function english() {
        Cache::forget('lang');
        Cache::put('lang','bng');
        $this->dispatch('reload-page');
    }
    public function bangla() {
        Cache::forget('lang');
        Cache::put('lang','en');
        $this->dispatch('reload-page');
    }
    public function render()
    {
        return view('home');
    }
}