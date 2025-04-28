<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Categorias;

class CategoriaController extends Controller
{
    public function index()
    {
        if (Auth::user()->username !== 'admin_cafesur') {
            abort(403, 'Acceso denegado.');
        }

        // Lógica para mostrar las categorías
    }

    public function store(Request $request)
    {
        if (!Gate::allows('admin-only')) {
            abort(403, 'Acceso denegado.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
        ]);

        Categorias::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('categorias')->with('success', 'Categoría agregada exitosamente.');
    }

    public function destroy($id)
    {
        $categoria = Categorias::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias')->with('success', 'Categoría eliminada exitosamente.');
    }
}