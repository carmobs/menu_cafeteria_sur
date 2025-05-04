<div class="alert-wrapper">
    @if(session('success'))
        <div class="custom-alert success" role="alert">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <h4>¡Éxito!</h4>
                <p>{{ session('success') }}</p>
            </div>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="custom-alert error" role="alert">
            <div class="alert-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="alert-content">
                <h4>¡Error!</h4>
                <p>{{ session('error') }}</p>
            </div>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
</div>
