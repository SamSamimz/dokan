<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $edit   = false;
    public $id     = null;
    public $category_data = [
        "name"        => '',
        "status"      => false,
        "description" => '',
    ];

    public function addCategory()
    {
        $this->validate([
            'category_data.name' => 'required',
        ]);
        $this->category_data['slug'] = Str::slug($this->category_data['name']);
        if ($this->edit) {
            dd($this->category_data);
            $category = Category::find($this->id)->toArray();
            $category = Auth::user()->categories()->where('id', $this->id)->update($this->category_data);
            if ($category) {
                $this->dispatch('close-modal');
                session()->flash('success', __('message.category updated'));
            }
        } else {

            $category = Auth::user()->categories()->create($this->category_data);
            if ($category) {
                $this->dispatch('close-modal');
                session()->flash('success', __('message.category addedd'));
            }
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id)->toArray();
        $this->category_data = $category;

        $this->dispatch('open-modal');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        session()->flash('success', __('message.category deleted'));
    }

    #[On('close-modal')]
    public function resetValue()
    {
        $this->reset();
    }

    public function render()
    {
        if ($this->search && strlen($this->search > 2)) {
            $categories = Category::with('user')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(7);
        } else {
            $categories = Category::with('user')->paginate(7);
        }
        return view('pages.category-index', compact('categories'));
    }
}
