@extends('layout')

@section('title', 'Gatos en Adopción')

@section('css')
<!-- Si necesitas estilos adicionales para esta vista, colócalos aquí -->
@endsection

@section('content')

<!-- Banner -->
<div class="banner mb-4">
    <div class="container text-white text-center">
        <h1>Encuentra tu Compañero Perfecto</h1>
        <p>Explora nuestra selección de gatos en adopción y dales una nueva oportunidad.</p>
    </div>
</div>

<!-- Filtros de búsqueda -->
<form class="row g-3 mb-4" method="GET" action="{{ route('gatos.index') }}">
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

<!-- Grid de Tarjetas -->
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
@endsection

@section('scripts')
<!-- Scripts adicionales si se necesitan -->
@endsection
