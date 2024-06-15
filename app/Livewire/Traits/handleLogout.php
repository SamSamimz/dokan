<?php
namespace App\Livewire\Traits;

use Illuminate\Support\Facades\Auth;

trait handleLogout{
    public function logout() {
        Auth::logout();
        session()->flash('You have been logged out');
        return redirect()->route('login');
    }
}

?>