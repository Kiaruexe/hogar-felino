<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Casas de Acogida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::check())
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('gatos.registro') }}" class="btn btn-primary me-2">
                Registrar Gato
            </a>
            <a href="{{ route('gatos.lista') }}" class="btn btn-primary me-2">
                Lista Gato
            </a>
            <form action="{{ route('logout.casa') }}" method="POST" onsubmit="return confirm('¿Estás seguro de salir?');">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>
        </div>
    @endif
    <h1>Bienvenido a Casas de Acogida</h1>
</div>
</body>
</html>
