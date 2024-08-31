<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductoIndex extends Component
{
    public function render()
    {
        $categories = Category::all();
        $productos = Product::all();

        return view('livewire.admin.producto-index', compact('categories', 'productos'));
    }
}
