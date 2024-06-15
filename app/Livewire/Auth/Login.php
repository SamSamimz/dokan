<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public function loginUser() {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username',$this->username)->first();
        if($user && Hash::check($this->password,$user->password)) {
            Auth::login($user);
            $this->redirect('/',navigate:true);
        }else {
            session()->flash('error','Invalid credentials');
        }
    }

    public function render()
    {
        return view('auth.login')->layout('layouts.auth');
    }
}
