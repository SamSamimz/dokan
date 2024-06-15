<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ProductIndex extends Component
{
    use WithPagination;
    public $edit = false;
    public $product_id = null;
    public $search = '';
    public $search_by_category = '';
    public $name = '';
    public $price = '';
    public $description = '';
    public $category_id = '';
    public $stock_quantity = '';
    public $status = true;
    public $company_name = '';

    protected $rules = [
        'name' => 'required|string',
        'description' => 'nullable|string',
        'category_id' => 'required',
        'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'company_name' => 'nullable|string',
        'stock_quantity' => 'required|integer',
    ];

    public function addProduct()
    {
        $this->validate();
        if ($this->edit && $this->product_id) {
            // dd($this->status);
            $product = auth()->user()->products()->where('id', $this->product_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'slug' => Str::slug($this->name),
                'price' => $this->price,
                'company_name' => $this->company_name,
                'status' => $this->status ? 'active' : 'inactive',
                'stock_quantity' => $this->stock_quantity,
            ]);
            if ($product) {
                session()->flash('success', __('message.product updated'));
                $this->closeModal();
            }
        } else {
            $product = auth()->user()->products()->create([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'slug' => Str::slug($this->name),
                'price' => $this->price,
                'company_name' => $this->company_name,
                'status' => $this->status ? 'active' : 'inactive',
                'stock_quantity' => $this->stock_quantity,
            ]);
            if ($product) {
                session()->flash('success', __('message.product added'));
                $this->closeModal();
            }
        };
    }

    public function editProduct(Product $product)
    {
        $this->edit = true;
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->company_name = $product->company_name;
        $this->stock_quantity = $product->stock_quantity;
        $this->status = $product->status == 'active' ? true : false;
        $this->openModal();
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        session()->flash('success', __('message.product deleted'));
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
        $categories = Category::all();
        $products = Product::paginate(7);
        if ($this->search_by_category) {
            if ($this->search && strlen($this->search) > 2) {
                $products = Product::
                where('category_id', $this->search_by_category)
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->paginate(7);
            }else {
                $products = Product::where('category_id', $this->search_by_category)->paginate(7);
            }
        }
        if ($this->search && strlen($this->search) > 2) {
            if($this->search_by_category) {
                $products = Product::
                where('name', 'LIKE', '%' . $this->search . '%')
                ->where('category_id', $this->search_by_category)
                ->paginate(7);
            }else {
                $products = Product::where('name', 'LIKE', '%' . $this->search . '%')->paginate(7);
            }
        }
        return view('pages.product-index', compact('products', 'categories'));
    }
}
