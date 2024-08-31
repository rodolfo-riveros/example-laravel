<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index()
    {
        return view('admin.producto.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' =>'required|exists:categories,id',
            'name'=> 'required',
            'description'=> 'required',
            'precio'=> 'required|numeric',
            'stock'=> 'required|integer',
        ]);

        try {
            $validator->validate();

            $producto = new Product();
            $producto->category_id = $request->category_id;
            $producto->name = $request->name;
            $producto->description = $request->description;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;

            $producto->save();

            if($producto) {
                return redirect()->route('admin.producto.index')->with('success', 'El producto fue registrado correctamente.');
            } else {
                return back()->withErrors(['general' => 'Ocurrio un errro al crear el producto.']);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->$validator->erros());
        }
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
