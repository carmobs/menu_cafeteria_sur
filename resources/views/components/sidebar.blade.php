<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6b21a8;">
    <div class="container-fluid">
        <a class="navbar-brand text-white d-flex align-items-center" href="/">
            <i class="fas fa-coffee me-2"></i> CaféSur
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="/"><i class="fas fa-home me-1"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('categorias') }}"><i class="fas fa-utensils me-1"></i> Menú</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login.form') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
