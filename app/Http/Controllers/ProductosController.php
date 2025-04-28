<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class ProductosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'imagen_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tipo_producto' => 'required|in:fijo,comida_diaria,especial',
            'disponible' => 'required|boolean',
        ]);

        $imagenPath = $request->file('imagen_url')->store('imagenes_productos', 'public');

        Productos::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen_url' => $imagenPath,
            'categoria_id' => $request->categoria_id,
            'tipo_producto' => $request->tipo_producto,
            'disponible' => $request->disponible,
        ]);

        return redirect()->back()->with('success', 'Producto agregado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'imagen_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tipo_producto' => 'required|in:fijo,comida_diaria,especial',
            'disponible' => 'required|boolean',
        ]);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->tipo_producto = $request->tipo_producto;
        $producto->disponible = $request->disponible;

        if ($request->hasFile('imagen_url')) {
            $imagenPath = $request->file('imagen_url')->store('imagenes_productos', 'public');
            $producto->imagen_url = $imagenPath;
        }

        $producto->save();

        return redirect()->back()->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();

        return redirect()->back()->with('success', 'Producto eliminado exitosamente.');
    }
}
