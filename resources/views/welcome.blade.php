@extends('components.layout')

@section('title', 'Bienvenido a CaféSur')

@section('content')
<div class="welcome-container">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="/assets/cafeteria sur.jpg" alt="Cafetería" class="welcome-image img-fluid w-100">
        </div>
        <div class="col-lg-6 text-center text-lg-start">
            <h1 class="welcome-title">¡Bienvenido a CafeSur!</h1>
            <p class="welcome-description lead">
                CafeSur es una de las cafeterías oficiales del <strong>Instituto Tecnológico de Colima</strong>, un espacio pensado para ti.
            </p>
            <p class="welcome-description">
                Aquí podrás conocer nuestro <strong>menú actualizado</strong>, con una variedad de bebidas, snacks y comidas ideales para acompañar tu día.
            </p>
            <div class="mt-4">
                <a href="{{ route('categorias') }}" class="btn btn-lg btn-purple">
                    <i class="fas fa-utensils me-2"></i>Ver Menú
                </a>
            </div>
        </div>
    </div>
    
    <footer class="welcome-footer mt-5 text-center rounded-4">
        <div class="row g-4">
            <div class="col-md-4">
                <i class="fas fa-phone-alt mb-2 text-purple fa-2x"></i>
                <p class="mb-0">(123) 456-7890</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-envelope mb-2 text-purple fa-2x"></i>
                <p class="mb-0">info@cafemenu.com</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-clock mb-2 text-purple fa-2x"></i>
                <p class="mb-0">Lun - Vie: 7:00 - 19:00</p>
            </div>
        </div>
    </footer>
</div>
@endsection
