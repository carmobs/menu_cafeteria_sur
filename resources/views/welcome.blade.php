@extends('components.layout')

@section('title', 'Bienvenido a CaféSur')

@section('content')
<div class="welcome-container text-center">
    <img src="/assets/cafeteria sur.jpg" alt="Cafetería" class="welcome-image img-fluid rounded shadow" style="max-width: 600px; height: auto;">
    <h1 class="welcome-title text-primary">¡Bienvenido a CaféSur!</h1>
    <p class="welcome-description">
        CaféSur es la cafetería oficial del <strong>Instituto Tecnológico de Colima</strong>, un espacio pensado para ti.
    </p>
    <p class="welcome-description">
        Aquí podrás conocer nuestro <strong>menú actualizado</strong>, con una variedad de bebidas, snacks y comidas ideales para acompañar tu día.
    </p>
    <p class="welcome-highlight">
        <i class="fas fa-star text-warning"></i> Consulta nuestro menú y ven a disfrutar de CaféSur. ¡Te esperamos!
    </p>
    <footer class="welcome-footer bg-light text-muted py-3">
        Contáctenos: (123) 456-7890 | <a href="mailto:info@cafemenu.com" class="text-primary">info@cafemenu.com</a>
    </footer>
</div>
@endsection
