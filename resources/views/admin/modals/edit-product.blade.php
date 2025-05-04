@foreach($productos as $producto)
    <div class="modal fade" id="editModal{{ $producto->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('productos.actualizar', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="categoria_id" value="{{ $producto->categoria_id }}">
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar: {{ $producto->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select name="categoria_id" class="form-select" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
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
                            <select class="form-select" name="tipo_producto" required>
                                <option value="fijo" {{ $producto->tipo_producto == 'fijo' ? 'selected' : '' }}>Fijo</option>
                                <option value="comida_diaria" {{ $producto->tipo_producto == 'comida_diaria' ? 'selected' : '' }}>Comida Diaria</option>
                                <option value="especial" {{ $producto->tipo_producto == 'especial' ? 'selected' : '' }}>Especial</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Disponible</label>
                            <select class="form-select" name="disponible" required>
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
@endforeach
