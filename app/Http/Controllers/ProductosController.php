<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categorias; // Agregar esta línea

class ProductosController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:1000',
                'precio' => 'required|numeric|min:0',
                'imagen_url' => 'required|url', // Validar que sea una URL
                'categoria_id' => 'required|exists:categorias,id', // Validar que la categoría exista
                'tipo_producto' => 'required|in:fijo,comida_diaria,especial',
                'disponible' => 'required|boolean',
            ]);

            Productos::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'imagen_url' => $request->imagen_url, // Guardar la URL de la imagen
                'categoria_id' => $request->categoria_id,
                'tipo_producto' => $request->tipo_producto,
                'disponible' => $request->disponible,
            ]);

            return redirect()->back()->with('success', 'Producto agregado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'La URL proporcionada no es válida. Por favor, verifica e intenta nuevamente.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $producto = Productos::findOrFail($id);

            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:1000',
                'precio' => 'required|numeric|min:0',
                'imagen_url' => 'required|url',
                'categoria_id' => 'required|exists:categorias,id',
                'tipo_producto' => 'required|in:fijo,comida_diaria,especial',
                'disponible' => 'required|boolean',
            ]);

            $producto->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'imagen_url' => $request->imagen_url,
                'categoria_id' => $request->categoria_id,
                'tipo_producto' => $request->tipo_producto,
                'disponible' => $request->disponible,
            ]);

            return redirect()->back()->with('success', 'Producto actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();

        return redirect()->back()->with('success', 'Producto eliminado exitosamente.');
    }

    public function dashboard()
    {
        $productos = Productos::with('categoria')->get();
        $categorias = Categorias::all();
        return view('admin.dashboard', compact('productos', 'categorias'));
    }

    public function toggleDisponibilidad(Request $request, $id)
    {
        try {
            $producto = Productos::findOrFail($id);
            $producto->disponible = $request->disponible;
            $producto->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado'
            ], 500);
        }
    }
}
