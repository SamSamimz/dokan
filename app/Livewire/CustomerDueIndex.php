<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class CustomerDueIndex extends Component
{
    public function render()
    {
        $customers = Customer::has('dues')->paginate(7);
        return view('pages.customer-due-index',compact('customers'));
    }
}