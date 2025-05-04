@extends('components.layout')

@section('title', 'Productos - ' . $categoria->nombre)

@section('content')
<div class="welcome-container">
    @component('components.breadcrumbs', ['categoria' => $categoria])
    @endcomponent

    @component('components.alert')
    @endcomponent

    <h1 class="welcome-title text-purple">Productos en {{ $categoria->nombre }}</h1>
    <p class="welcome-description">Explora los productos disponibles en la categoría <strong>{{ $categoria->nombre }}</strong>.</p>

    @if(Auth::check())
        <div class="mb-3">
            <button class="btn btn-success" 
                    data-bs-toggle="tooltip" 
                    data-bs-target="#addProductModal"
                    data-bs-placement="top"
                    title="Agregar un nuevo producto a esta categoría"
                    onclick="$('#addProductModal').modal('show');">
                <i class="fas fa-plus me-1"></i>Agregar Producto
            </button>
        </div>
    @endif

    <div class="row g-2"> <!-- Cambiar g-2 para reducir el espacio entre las tarjetas -->
        @forelse($productos as $producto)
            @if($producto->disponible || Auth::check()) <!-- Mostrar solo si está disponible o si es administrador -->
                <div class="col-md-4 mb-2"> <!-- Reducir el margen inferior -->
                    <div class="card shadow-sm {{ !$producto->disponible ? 'producto-agotado' : '' }}">
                        <img src="{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        <div class="card-body text-center">
                            <h5 class="card-title text-purple">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted">{{ $producto->descripcion }}</p>
                            <p class="card-text text-price"><strong>${{ number_format($producto->precio, 2) }}</strong></p> <!-- Clase text-price -->
                            @if(Auth::check())
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" 
                                            class="btn btn-warning btn-sm" 
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Modificar información del producto"
                                            onclick="$('#editModal{{ $producto->id }}').modal('show');">
                                        <i class="fas fa-edit"></i> Actualizar
                                    </button>
                                    <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Eliminar permanentemente este producto">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if(!$producto->disponible)
                                <span class="badge bg-danger mt-2" 
                                      data-bs-toggle="tooltip" 
                                      data-bs-placement="bottom" 
                                      title="Este producto no está disponible actualmente">
                                    No disponible
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modal para editar producto -->
            <div class="modal fade" id="editModal{{ $producto->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $producto->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('productos.actualizar', $producto->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="categoria_id" value="{{ $categoriaId }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $producto->id }}">Actualizar Producto: {{ $producto->nombre }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Precio</label>
                                    <input type="number" class="form-control" name="precio" value="{{ $producto->precio }}" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">URL de la Imagen</label>
                                    <input type="url" class="form-control" name="imagen_url" value="{{ $producto->imagen_url }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Producto</label>
                                    <select class="form-control" name="tipo_producto" required>
                                        <option value="fijo" {{ $producto->tipo_producto == 'fijo' ? 'selected' : '' }}>Fijo</option>
                                        <option value="comida_diaria" {{ $producto->tipo_producto == 'comida_diaria' ? 'selected' : '' }}>Comida Diaria</option>
                                        <option value="especial" {{ $producto->tipo_producto == 'especial' ? 'selected' : '' }}>Especial</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Disponible</label>
                                    <select class="form-control" name="disponible" required>
                                        <option value="1" {{ $producto->disponible ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ !$producto->disponible ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
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
            <form action="{{ route('productos.agregar') }}" method="POST">
                @csrf
                <input type="hidden" name="categoria_id" value="{{ $categoriaId }}"> <!-- Campo oculto -->
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
                        <label for="imagen_url" class="form-label">URL de la Imagen</label>
                        <input type="url" class="form-control" id="imagen_url" name="imagen_url" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_producto" class="form-label">Tipo de Producto</label>
                        <select class="form-control" id="tipo_producto" name="tipo_producto" required>
                            <option value="fijo">Fijo</option>
                            <option value="comida_diaria">Comida Diaria</option>
                            <option value="especial">Especial</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="disponible" class="form-label">Disponible</label>
                        <select class="form-control" id="disponible" name="disponible" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
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
