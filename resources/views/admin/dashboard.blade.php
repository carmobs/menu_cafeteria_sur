@extends('components.layout')

@section('title', 'Panel de Control - CaféSur')

@section('content')
<div class="welcome-container">
    <div class="admin-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="welcome-title text-purple mb-0">Panel de Control</h1>
            <nav aria-label="breadcrumb" class="admin-breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="breadcrumb-link"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active">Panel de Control</li>
                </ol>
            </nav>
        </div>
    </div>

    @component('components.alert')
    @endcomponent

    <!-- Estadísticas Rápidas -->
    <div class="stats-container mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $productos->count() }}</h3>
                        <p>Productos Totales</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $productos->where('disponible', true)->count() }}</h3>
                        <p>Productos Disponibles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $categorias->count() }}</h3>
                        <p>Categorías</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Controles de búsqueda y filtrado -->
    <div class="admin-controls">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar productos...">
                </div>
            </div>
            <div class="col-md-3">
                <select id="categoriaFilter" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="disponibilidadFilter" class="form-select">
                    <option value="">Disponibilidad</option>
                    <option value="1">Disponible</option>
                    <option value="0">No disponible</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100" 
                        data-bs-toggle="modal" 
                        data-bs-target="#addProductModal"
                        data-bs-tooltip="tooltip"
                        title="Agregar nuevo producto">
                    <i class="fas fa-plus me-2"></i>Nuevo
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de productos con skeleton loading -->
    <div class="table-responsive">
        <table class="table admin-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productosTable">
                @foreach($productos as $producto)
                    <tr data-categoria="{{ $producto->categoria_id }}" 
                        data-disponible="{{ $producto->disponible }}"
                        data-nombre="{{ strtolower($producto->nombre) }}">
                        <td>
                            <img src="{{ $producto->imagen_url }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="admin-thumbnail"
                                 data-bs-toggle="tooltip"
                                 title="{{ $producto->nombre }}">
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>
                            <select class="form-select estado-select badge {{ $producto->disponible ? 'bg-success' : 'bg-danger' }}"
                                    data-id="{{ $producto->id }}"
                                    style="width: auto; 
                                           border: none; 
                                           padding: 6px 12px; 
                                           -webkit-appearance: none;
                                           -moz-appearance: none;
                                           appearance: none;
                                           cursor: pointer;
                                           text-align: center;
                                           min-width: 120px;">
                                <option value="1" {{ $producto->disponible ? 'selected' : '' }}>Disponible</option>
                                <option value="0" {{ !$producto->disponible ? 'selected' : '' }}>No disponible</option>
                            </select>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" 
                                        class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $producto->id }}"
                                        data-bs-tooltip="tooltip"
                                        title="Editar producto">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" 
                                        class="btn btn-danger btn-sm"
                                        data-bs-tooltip="tooltip"
                                        title="Eliminar producto"
                                        onclick="confirmarEliminacion({{ $producto->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Incluir modales de edición y creación -->
@include('admin.modals.edit-product')
@include('admin.modals.add-product')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Función de búsqueda y filtrado
    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoria = document.getElementById('categoriaFilter').value;
        const disponibilidad = document.getElementById('disponibilidadFilter').value;
        
        const rows = document.querySelectorAll('#productosTable tr');
        
        rows.forEach(row => {
            const nombre = row.dataset.nombre;
            const categoriaId = row.dataset.categoria;
            const disponible = row.dataset.disponible;
            
            const matchSearch = nombre.includes(searchTerm);
            const matchCategoria = !categoria || categoriaId === categoria;
            const matchDisponibilidad = !disponibilidad || disponible === disponibilidad;
            
            if (matchSearch && matchCategoria && matchDisponibilidad) {
                row.classList.remove('d-none');
            } else {
                row.classList.add('d-none');
            }
        });
    }

    // Event listeners para filtros
    document.getElementById('searchInput').addEventListener('input', filterTable);
    document.getElementById('categoriaFilter').addEventListener('change', filterTable);
    document.getElementById('disponibilidadFilter').addEventListener('change', filterTable);

    // Agregar esto dentro del DOMContentLoaded existente
    document.querySelectorAll('.estado-select').forEach(select => {
        select.addEventListener('change', function() {
            const isDisponible = this.value === '1';
            this.className = `form-select estado-select badge ${isDisponible ? 'bg-success' : 'bg-danger'}`;
            
            // Actualizar el dataset para los filtros
            this.closest('tr').dataset.disponible = isDisponible ? '1' : '0';

            fetch(`/admin/productos/${this.dataset.id}/toggle-disponibilidad`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ disponible: isDisponible })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                // Revertir en caso de error
                const revertido = !isDisponible;
                this.value = revertido ? '1' : '0';
                this.className = `form-select estado-select badge ${revertido ? 'bg-success' : 'bg-danger'}`;
                this.closest('tr').dataset.disponible = revertido ? '1' : '0';
                alert('Error al actualizar el estado: ' + error.message);
            });
        });
    });
});

// Función para confirmar eliminación
function confirmarEliminacion(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        document.getElementById('deleteForm-' + id).submit();
    }
}
</script>
@endsection
