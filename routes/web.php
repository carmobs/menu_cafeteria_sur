<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', [CatalogosController::class, 'categorias'])->name('categorias');
Route::get('/categorias/{id}/productos', [CatalogosController::class, 'productosPorCategoria'])->name('productos.por.categoria');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/categorias', [CategoriasController::class, 'index'])->name('admin.categorias');
    Route::get('/admin/productos', [ProductosController::class, 'index'])->name('admin.productos');
    Route::post('/admin/categorias/agregar', [CategoriasController::class, 'store'])->name('admin.categorias.agregar');
    Route::delete('/admin/categorias/eliminar/{id}', [CategoriasController::class, 'destroy'])->name('admin.categorias.eliminar');
    Route::post('/admin/productos/agregar', [ProductosController::class, 'store'])->name('admin.productos.agregar');
    Route::delete('/admin/productos/eliminar/{id}', [ProductosController::class, 'destroy'])->name('admin.productos.eliminar');
    Route::post('/categorias/agregar', [CategoriasController::class, 'store'])->name('categorias.agregar');
    Route::delete('/categorias/eliminar/{id}', [CategoriasController::class, 'destroy'])->name('categorias.eliminar');
    Route::post('/productos/agregar', [ProductosController::class, 'store'])->name('productos.agregar');
    Route::put('/productos/actualizar/{id}', [ProductosController::class, 'update'])->name('productos.actualizar');
    Route::delete('/productos/eliminar/{id}', [ProductosController::class, 'destroy'])->name('productos.eliminar');
});
