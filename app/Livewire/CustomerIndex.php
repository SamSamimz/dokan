<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class CustomerIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $customer_id = null;
    public $edit = false;
    public $name = '';
    public $email = '';
    public $address = '';
    public $phone = '';

    // protected $rules = [
    //     'name' => 'required|string',
    //     'email' => 'required|email|unique:customers,email',
    //     'address' => 'nullable|string',
    //     'phone' => 'required',
    // ];
    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($this->customer_id),
            ],
            'address' => 'nullable|string',
            'phone' => 'required',
        ];
    }
    public function addCustomer()
    {
        $this->validate();
        if ($this->edit && $this->customer_id) {
            $customer = Customer::where('id', $this->customer_id)->update([
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone,
            ]);
            if($customer) {
                $this->closeModal();
                session()->flash('success',__('message.customer updated'));
            }
        } else {
            $customer = Customer::create([
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone,
            ]);
            if($customer) {
                $this->closeModal();
                session()->flash('success',__('message.customer added'));
            }
        }
    }

    public function editCustomer(Customer $customer)
    {
        $this->edit = true;
        $this->customer_id = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->address = $customer->address;
        $this->phone = $customer->phone;
        $this->openModal();
    }

    public function deleteCustomer(Customer $customer) {
        $customer->delete();
        session()->flash('success', __('message.customer deleted'));
    }

    public function openModal()
    {
        $this->edit ? null : $this->reset();
        $this->dispatch('open-modal');
    }

    public function closeModal()
    {
        $this->dispatch('close-modal');
        $this->reset();
    }


    public function render()
    {
        $customers = Customer::paginate(7);
        if($this->search && strlen($this->search) > 2) {
            $customers = Customer::where('name','LIKE','%'.$this->search.'%')
            ->paginate(7);
        }
        return view('pages.customer-index', compact('customers'));
    }
}
