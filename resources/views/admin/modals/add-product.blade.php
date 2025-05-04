<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('productos.agregar') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="categoria_id" class="form-select" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" step="0.01" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">URL de la Imagen</label>
                        <input type="url" class="form-control" name="imagen_url" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tipo de Producto</label>
                        <select class="form-select" name="tipo_producto" required>
                            <option value="fijo">Fijo</option>
                            <option value="comida_diaria">Comida Diaria</option>
                            <option value="especial">Especial</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Disponible</label>
                        <select class="form-select" name="disponible" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Agregar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>
