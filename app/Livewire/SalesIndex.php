<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SalesIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $edit = false;
    public $customer_id;
    public $product_id;
    public $product_quantity = 1;
    public $total_price;
    public $payed_amount;
    public $due_amount;
    public $due_date = '';
    public $filter_date = 'todays';

    public function mount() {
        $this->calculatePrice();
        $this->calculateDue();
    }

    protected $rules = [
        'customer_id' => 'required',
        'product_id' => 'required',
        'product_quantity' => 'required|integer',
        'total_price' => 'required|numeric',
        'payed_amount' => 'nullable|numeric',
        'due_amount' => 'nullable|numeric',
        'due_date' => 'nullable|date',
    ];
    public function addSale()
    {
        $this->validate();
        $sale = auth()->user()->sales()->create([
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id,
            'product_quantity' => $this->product_quantity,
            'total_price' => $this->total_price,
            'payed_amount' => $this->payed_amount,
            'due_amount' => $this->due_amount,
            'due_date' => $this->due_date,
        ]);
        if($sale) {
            session()->flash('success', __('message.sale added'));
            $this->closeModal();
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['product_id', 'product_quantity','total_price'])) {
            $this->calculatePrice();
        }
        if(in_array($propertyName, ['total_price','payed_amount','due_amount'])) {
            $this->calculateDue();
        }
    }

    public function calculateDue() {
        if($this->total_price > 0 && $this->payed_amount > 0) {
            $this->due_amount = ((int)$this->total_price - (int)$this->payed_amount);
        }
    }

    public function calculatePrice()
    {
        if ($this->product_id) {
            $product = Product::find($this->product_id);
            if ($product) {
                $this->total_price = ((int)$product->price * (int)$this->product_quantity);
            } else {
                $this->total_price = 0;
            }
        } else {
            $this->total_price = 0;
        }
    }

    public function deleteSale(Sale $sale) {
        if($sale) {
            $sale->delete();
            session()->flash('success', __('message.sale deleted'));
        }
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
        $products = Product::all();
        $customers = Customer::all();
        $sales = Sale::whereDate('created_at',Carbon::today()->toDateString())->paginate(7);
        if($this->filter_date == 'todays') {
            $sales = Sale::whereDate('created_at',Carbon::today()->toDateString())->paginate(7);
        }
        if($this->filter_date == 'week') {
            $s_Week = Carbon::now()->startOfWeek();
            $e_Week = Carbon::now()->endOfWeek();
            $sales = Sale::whereBetween('created_at',[$s_Week,$e_Week])->paginate(7);
        }
        if($this->filter_date == 'month') {
            $month = Carbon::now()->month;
            // $year = Carbon::now()->year();
            $sales = Sale::whereMonth('created_at',$month)
            ->paginate(3);
        }
        if($this->filter_date == '') {   
            $sales = Sale::paginate(7);
        }
        return view('pages.sales-index', compact('sales', 'products', 'customers'));
    }
}
