@extends('components.layout')

@section('title', 'Iniciar Sesión - CaféSur')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="login-card">
                <div class="text-center mb-4">
                    <div class="login-icon-wrapper">
                        <i class="fas fa-coffee login-icon"></i>
                    </div>
                    <h2 class="welcome-title mb-2">¡Bienvenido!</h2>
                    <p class="text-muted">Panel de Administración CaféSur</p>
                </div>

                @if ($errors->has('login'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="login-form">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-purple w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
