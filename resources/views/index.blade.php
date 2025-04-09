<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>KiwokoAdopta - Gatos en Adopción</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        /* Estilo para la barra de navegación */
        .navbar {
            background-color: #006d77; /* Color base, puedes cambiarlo */
        }
        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .nav-link:hover {
            color: #83c5be !important;
        }
        /* Banner principal */
        .banner {
            background-image: url('/images/prueba.jpeg');
            background-size: cover;
            background-position: center;
            padding: 3rem 0;
            color: #fff;
            text-align: center;
        }
        .banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .banner p {
            font-size: 1.25rem;
        }
        /* Grid de tarjetas */
        .card {
            border: none;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            background-color: #fff;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }
        /* Footer */
        footer {
            background-color: #006d77;
            color: #fff;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{ route('gatos.index') }}">
          <img src="/images/logo.png" alt="Logo">
          KiwokoAdopta
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('gatos.index') }}">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('gato.registro') }}">Registrar Gato</a>
            </li>
            <!-- Agrega otros enlaces de ser necesarios -->
          </ul>
        </div>
      </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <div class="container">
            <h1>Encuentra tu Compañero Perfecto</h1>
            <p>Explora nuestra selección de gatos en adopción y dales una nueva oportunidad.</p>
        </div>
    </div>

    <!-- Opcional: Filtros o búsqueda -->
    <div class="container my-4">
        <form class="row g-3" method="GET" action="{{ route('gatos.index') }}">
            <div class="col-md-4">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="sexo">
                    <option value="">Todos los sexos</option>
                    <option value="macho" {{ request('sexo') == 'macho' ? 'selected' : '' }}>Macho</option>
                    <option value="hembra" {{ request('sexo') == 'hembra' ? 'selected' : '' }}>Hembra</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>
    </div>

    <!-- Grid de Tarjetas -->
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($gatos as $gato)
                <div class="col">
                    <div class="card">
                        @if ($gato->imagen)
                            <img src="data:image/jpeg;base64,{{ base64_encode($gato->imagen) }}" 
                                 class="card-img-top" 
                                 alt="Imagen de {{ $gato->nombre }}">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=Sin+Imagen" 
                                 class="card-img-top" 
                                 alt="Sin imagen">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $gato->nombre }}</h5>
                            <p class="card-text">
                                <small>
                                    <strong>Nacimiento:</strong> {{ $gato->edad ? \Carbon\Carbon::parse($gato->edad)->format('d/m/Y') : '-' }}<br>
                                    @if($gato->edad)
                                        <strong>Edad:</strong> {{ \Carbon\Carbon::parse($gato->edad)->age }} años
                                    @endif
                                </small>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('gatos.mostrar', $gato->id) }}" class="btn btn-secondary btn-sm">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No se encontraron gatos en adopción.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} KiwokoAdopta. Todos los derechos reservados.</p>
            <p>
                <a href="#">Contacto</a> |
                <a href="#">Política de Privacidad</a> |
                <a href="#">Términos y Condiciones</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
