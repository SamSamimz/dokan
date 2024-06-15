<?php 
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;

Route::get('/login',Login::class)->name('login');


?>