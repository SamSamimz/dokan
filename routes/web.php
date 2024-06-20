<?php

use App\Livewire\CategoryIndex;
use App\Livewire\CustomerDueIndex;
use App\Livewire\CustomerIndex;
use App\Livewire\DueIndex;
use App\Livewire\Home;
use App\Livewire\ProductIndex;
use App\Livewire\SalesIndex;
use Illuminate\Support\Facades\Route;


// Protected Routes for Authenticated Users,
Route::middleware(['auth'])->group(function() {
    Route::get('/',Home::class)->name('home');
    Route::get('/categories',CategoryIndex::class)->name('category.index');
    Route::get('/products',ProductIndex::class)->name('products.index');
    Route::get('/customers',CustomerIndex::class)->name('customers.index');
    Route::get('/sales',SalesIndex::class)->name('sales.index');
    Route::get('/dues',DueIndex::class)->name('dues.index');
    Route::get('/customer-dues',CustomerDueIndex::class)->name('customer-dues.index');
});


require __DIR__.'/auth.php';