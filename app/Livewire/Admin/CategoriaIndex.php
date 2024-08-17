<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoriaIndex extends Component
{
    public function render()
    {
        $category = Category::all();

        return view('livewire.admin.categoria-index', compact('category'));
    }
}
