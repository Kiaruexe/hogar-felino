<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Casas de Acogida - @yield('title','Inicio')</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @yield('css')
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('gatos.lista') }}">Casas de Acogida</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registro') }}">Registrar Casa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gatos.lista') }}">Lista Gato</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <!-- Formulario de logout en la navegación -->
                        <form action="{{ route('logout.casa') }}" method="POST" onsubmit="return confirm('¿Estás seguro de salir?');" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link" style="border: none; background: none; padding: 0;">Cerrar sesión</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>&copy; {{ date('Y') }} Casas de Acogida. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
