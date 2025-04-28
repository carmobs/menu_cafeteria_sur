@extends('components.layout')

@section('title', 'Iniciar Sesión - CaféSur')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h1 class="text-center welcome-title text-purple mb-4">Iniciar Sesión</h1>
        <p class="text-center welcome-description">Accede como administrador para gestionar productos.</p>
        <form action="{{ route('login') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-purple w-100">Iniciar Sesión</button>
        </form>
        @if ($errors->has('login'))
            <div class="alert alert-danger mt-3">
                {{ $errors->first('login') }}
            </div>
        @endif
    </div>
</div>
@endsection
