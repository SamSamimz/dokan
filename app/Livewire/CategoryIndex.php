<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $edit = false;
    public $id = null;
    public $name = '';
    public $status = true;
    public $description = '';
    public function addCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);
        if ($this->edit) {
            $category = Auth::user()->categories()->where('id', $this->id)->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'status' => $this->status ? 'active' : 'inactive',
                'description' => $this->description,
            ]);
            if ($category) {
                $this->dispatch('close-modal');
                session()->flash('success', __('message.category updated'));
            }
        } else {
            $category = Auth::user()->categories()->create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'status' => $this->status ? 'active' : 'inactive',
                'description' => $this->description,
            ]);
            if ($category) {
                $this->dispatch('close-modal');
                session()->flash('success', __('message.category addedd'));
            }
        }
    }

    public function editCategory(Category $category)
    {
        $this->id = $category->id;
        $this->edit = true;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->status = $category->status == 'active' ? true : false;
        $this->openModal();
        // session()->flash('success',__('message.category deleted'));
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        session()->flash('success', __('message.category deleted'));
    }

    public function openModal()
    {
        $this->edit ? null : $this->reset();
        $this->dispatch('open-modal');
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function render()
    {
        if ($this->search && strlen($this->search > 2)) {
            $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')->paginate(7);
        } else {
            $categories = Category::paginate(7);
        }
        return view('pages.category-index', compact('categories'));
    }
}
