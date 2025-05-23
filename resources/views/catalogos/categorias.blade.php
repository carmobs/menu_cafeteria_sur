@extends('components.layout')

@section('title', 'Categorías - CaféSur')

@section('content')
<div class="welcome-container">
    @component('components.breadcrumbs')
    @endcomponent

    <h1 class="welcome-title text-purple">Categorías</h1>
    <p class="welcome-description">Explora nuestras categorías de productos disponibles en CaféSur.</p>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/jugos%20y%20licuados.jpg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Jugos y Licuados</h5>
                        <p class="card-text text-light">Bebidas naturales y licuados energéticos preparados con frutas frescas.</p>
                        <a href="{{ route('productos.por.categoria', 1) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/bebidas.jpg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Bebidas</h5>
                        <p class="card-text text-light">Variedad de bebidas frías y calientes para acompañar tus alimentos.</p>
                        <a href="{{ route('productos.por.categoria', 2) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/BOWLS.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Bowls</h5>
                        <p class="card-text text-light">Opciones nutritivas de bowls con frutas, granola, avena y más.</p>
                        <a href="{{ route('productos.por.categoria', 3) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/ensaladas.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Ensaladas</h5>
                        <p class="card-text text-light">Ensaladas frescas y saludables con opción de proteína extra.</p>
                        <a href="{{ route('productos.por.categoria', 4) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/tacos.webp') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Tacos</h5>
                        <p class="card-text text-light">Tacos de asada o adobada, ideales para un antojo rápido.</p>
                        <a href="{{ route('productos.por.categoria', 5) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/baguettes.jpg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Baguettes</h5>
                        <p class="card-text text-light">Baguettes rellenos de pollo, panela, jamón o atún.</p>
                        <a href="{{ route('productos.por.categoria', 6) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/tortas.jpg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Tortas</h5>
                        <p class="card-text text-light">Tortas clásicas y de especialidad en pan de telera.</p>
                        <a href="{{ route('productos.por.categoria', 7) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/hamburguesa.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Hamburguesas</h5>
                        <p class="card-text text-light">Hamburguesas vegetarianas saludables en pan de espinacas.</p>
                        <a href="{{ route('productos.por.categoria', 8) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/sandwich.jpg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Sándwiches</h5>
                        <p class="card-text text-light">Sándwiches de panela, pollo y otros ingredientes frescos.</p>
                        <a href="{{ route('productos.por.categoria', 9) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/Molletes.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Molletes</h5>
                        <p class="card-text text-light">Molletes tradicionales, veganos y ligeros para todos los gustos.</p>
                        <a href="{{ route('productos.por.categoria', 10) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/quesadillas.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Quesadillas</h5>
                        <p class="card-text text-light">Quesadillas sencillas o con champiñones.</p>
                        <a href="{{ route('productos.por.categoria', 11) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/desayuno%20del%20dia.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Desayunos</h5>
                        <p class="card-text text-light">Desayuno completo del día para comenzar con energía.</p>
                        <a href="{{ route('productos.por.categoria', 12) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm category-card" style="background-image: url('{{ secure_asset('assets/imagenes%20categorias/menu%20del%20dia.jpeg') }}');">
                <div class="card-overlay">
                    <div class="card-body text-center">
                        <h5 class="card-title text-white">Menú del Día</h5>
                        <p class="card-text text-light">Platillo completo que varía diariamente.</p>
                        <a href="{{ route('productos.por.categoria', 13) }}" class="btn btn-purple">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
