<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Gatos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Gatos Disponibles</h2>

    @if ($gatos->isEmpty())
        <div class="alert alert-info text-center">
            No hay gatos registrados.
        </div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach ($gatos as $gato)
                <div class="col">
                    <div class="card h-100">
                        @if ($gato->imagen)
                            <a href="{{ route('gatos.mostrar', $gato->id) }}">
                                <img src="data:image/jpeg;base64,{{ base64_encode($gato->imagen) }}"
                                     class="card-img-top"
                                     alt="Imagen de {{ $gato->nombre }}"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                        @else
                            <a href="{{ route('gatos.show', $gato->id) }}">
                                <img src="https://via.placeholder.com/300x200?text=Sin+Imagen"
                                     class="card-img-top"
                                     alt="Sin imagen"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="{{ route('gatos.mostrar', $gato->id) }}" class="text-decoration-none text-dark">
                                    {{ $gato->nombre }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
