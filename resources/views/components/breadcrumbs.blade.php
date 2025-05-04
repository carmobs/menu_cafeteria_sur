<nav aria-label="breadcrumb" class="breadcrumbs-nav">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/" class="breadcrumb-link">
                <i class="fas fa-home"></i> Inicio
            </a>
        </li>
        
        @if(isset($categoria))
            <li class="breadcrumb-item">
                <a href="{{ route('categorias') }}" class="breadcrumb-link">
                    <i class="fas fa-utensils"></i> Menú
                </a>
            </li>
            <li class="breadcrumb-item active">
                <i class="fas fa-tag"></i> {{ $categoria->nombre }}
            </li>
        @elseif(Request::is('categorias'))
            <li class="breadcrumb-item active">
                <i class="fas fa-utensils"></i> Menú
            </li>
        @endif
    </ol>
</nav>
