<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('admin.categoria.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'color' => 'required',
        ]);

        $categorias = new Category();

        $categorias->name = $validatedData['name'];
        $categorias->description = $validatedData['description'];
        $categorias->color = $validatedData['color'];

        $categorias->save();

        if ($categorias){
            return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registro correctamente la categoria:' . $categorias->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'color' => 'required',
        ]);

        $categorias = Category::findOrFail($id);

        $categorias->name = $validatedData['name'];
        $categorias->description = $validatedData['description'];
        $categorias->color = $validatedData['color'];

        $categorias->save();

        if ($categorias){
            return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue actualizado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se actualizo correctamente la categoria:' . $categorias->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue eliminado correctamente.');
    }
}
