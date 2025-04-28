@extends('components.layout')

@section('title', 'Productos - ' . $categoria->nombre)

@section('content')
<div class="welcome-container">
    <h1 class="welcome-title text-purple">Productos en {{ $categoria->nombre }}</h1>
    <p class="welcome-description">Explora los productos disponibles en la categoría <strong>{{ $categoria->nombre }}</strong>.</p>
    
    @if(Auth::check())
        <div class="mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar Producto</button>
        </div>
    @endif

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="/storage/{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body text-center">
                        <h5 class="card-title text-purple">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted">{{ $producto->descripcion }}</p>
                        <p class="card-text text-primary"><strong>${{ number_format($producto->precio, 2) }}</strong></p>
                        @if(Auth::check())
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $producto->id }}">Actualizar</button>
                            <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal para actualizar producto -->
            <div class="modal fade" id="editProductModal-{{ $producto->id }}" tabindex="-1" aria-labelledby="editProductModalLabel-{{ $producto->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('productos.actualizar', $producto->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel-{{ $producto->id }}">Actualizar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nombre-{{ $producto->id }}" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre-{{ $producto->id }}" name="nombre" value="{{ $producto->nombre }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion-{{ $producto->id }}" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion-{{ $producto->id }}" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="precio-{{ $producto->id }}" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="precio-{{ $producto->id }}" name="precio" value="{{ $producto->precio }}" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="imagen_url-{{ $producto->id }}" class="form-label">Imagen</label>
                                    <input type="file" class="form-control" id="imagen_url-{{ $producto->id }}" name="imagen_url">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No hay productos disponibles en esta categoría.</p>
        @endforelse
    </div>
</div>

<!-- Modal para agregar producto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('productos.agregar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen_url" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen_url" name="imagen_url" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
