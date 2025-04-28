<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;

class CatalogosController extends Controller
{
    public function categorias()
    {
        $categorias = Categorias::all();
        return view('catalogos.categorias', compact('categorias'));
    }

    public function productosPorCategoria($categoriaId)
    {
        $productos = Productos::where('categoria_id', $categoriaId)->get();
        $categoria = Categorias::findOrFail($categoriaId);
        return view('catalogos.productos', compact('productos', 'categoria'));
    }
}
