<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Casas de Acogida - @yield('title','Inicio')</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @yield('css')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="{{ route('gatos.index') }}">
                <img src="/images/logo.png" alt="Logo" />
                <span class="ms-2">Hogar Felino</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Sobre Nosotros</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registro') }}">Registrar Casa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        @php $user = Auth::user(); @endphp
                        @if($user->rol === 'casa')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('casa') }}">Zona Casa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contacto.recibidos') }}">Mensajes Recibidos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gatos.registro') }}">Crear Gato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('casa.perfil.edit') }}">Editar Perfil</a>
                            </li>

                        @elseif($user->rol === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Zona Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('casa.perfil.edit') }}">Editar Perfil</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout.casa') }}" method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de salir?');" 
                                  class="d-inline">
                                @csrf
                                <button type="submit" 
                                        class="nav-link btn btn-danger m-0 px-2" 
                                        style="line-height: 1.5;">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="content">
        <div class="container mt-5">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; {{ date('Y') }} Hogar Felino. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>