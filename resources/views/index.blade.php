@extends('layout')

@section('title', 'Gatos en Adopción')

@section('css')
<!-- Estilos adicionales si es necesario -->
@endsection

@section('content')

<!-- Banner -->
<div class="banner mb-4">
    <div class="container text-white text-center">
        <h1>Encuentra tu Compañero Perfecto</h1>
        <p>Explora nuestra selección de gatos en adopción y dales una nueva oportunidad.</p>
    </div>
</div>

<!-- Formulario de filtros -->
<form class="row g-3 mb-4" method="GET" action="{{ route('gatos.index') }}">

    <div class="col-md-2">
        <select class="form-select" name="sexo">
            <option value="">Todos los sexos</option>
            <option value="macho" {{ request('sexo') == 'macho' ? 'selected' : '' }}>Macho</option>
            <option value="hembra" {{ request('sexo') == 'hembra' ? 'selected' : '' }}>Hembra</option>
        </select>
    </div>
    <div class="col-md-3">
        <input type="text" name="raza" class="form-control" placeholder="Buscar por raza..." value="{{ request('raza') }}">
    </div>
    <div class="col-md-3">
        <select class="form-select" name="localizacion">
            <option value="">Todas las localizaciones</option>
            @php
                $provincias = [
                    'Alava' => 'Álava', 'Albacete' => 'Albacete', 'Alicante' => 'Alicante', 'Almeria' => 'Almería',
                    'Asturias' => 'Asturias', 'Avila' => 'Ávila', 'Badajoz' => 'Badajoz', 'Barcelona' => 'Barcelona',
                    'Burgos' => 'Burgos', 'Caceres' => 'Cáceres', 'Cadiz' => 'Cádiz', 'Cantabria' => 'Cantabria',
                    'Castellon' => 'Castellón', 'Ciudad Real' => 'Ciudad Real', 'Cordoba' => 'Córdoba', 'Cuenca' => 'Cuenca',
                    'Girona' => 'Girona', 'Granada' => 'Granada', 'Guadalajara' => 'Guadalajara', 'Guipuzcoa' => 'Guipúzcoa',
                    'Huelva' => 'Huelva', 'Huesca' => 'Huesca', 'Islas Baleares' => 'Islas Baleares', 'Jaen' => 'Jaén',
                    'La Rioja' => 'La Rioja', 'Las Palmas' => 'Las Palmas', 'Leon' => 'León', 'Lerida' => 'Lérida',
                    'Lugo' => 'Lugo', 'Madrid' => 'Madrid', 'Malaga' => 'Málaga', 'Murcia' => 'Murcia',
                    'Navarra' => 'Navarra', 'Ourense' => 'Ourense', 'Palencia' => 'Palencia', 'Pontevedra' => 'Pontevedra',
                    'Salamanca' => 'Salamanca', 'Santa Cruz de Tenerife' => 'Santa Cruz de Tenerife',
                    'Segovia' => 'Segovia', 'Sevilla' => 'Sevilla', 'Soria' => 'Soria', 'Tarragona' => 'Tarragona',
                    'Teruel' => 'Teruel', 'Toledo' => 'Toledo', 'Valencia' => 'Valencia', 'Valladolid' => 'Valladolid',
                    'Vizcaya' => 'Vizcaya', 'Zamora' => 'Zamora', 'Zaragoza' => 'Zaragoza'
                ];
            @endphp
            @foreach($provincias as $clave => $valor)
                <option value="{{ $clave }}" {{ request('localizacion') == $clave ? 'selected' : '' }}>{{ $valor }}</option>
            @endforeach
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
                        <strong>Nacimiento:</strong> 
                        {{ $gato->edad ? \Carbon\Carbon::parse($gato->edad)->format('d/m/Y') : '-' }}<br>
                        @if($gato->edad)
                            @php
                                $birthDate = \Carbon\Carbon::parse($gato->edad);
                                $now = \Carbon\Carbon::now();
                                $diff = $birthDate->diff($now);
                                $years = $diff->y;
                                $months = $diff->m;
                            @endphp
                            @if($years > 0 && $months > 0)
                            
                            <p class="card-text"> <strong>Edad:</strong> {{ $years }} {{ $years == 1 ? 'año' : 'años' }} y {{ $months }} {{ $months == 1 ? 'mes' : 'meses' }}
                            @elseif($years > 0)
                                <strong>Edad:</strong> {{ $years }} {{ $years == 1 ? 'año' : 'años' }}
                            @else
                                <strong>Edad:</strong> {{ $months }} {{ $months == 1 ? 'mes' : 'meses' }}
                            @endif
                        @endif
                        <br><strong>Sexo:</strong> {{ ucfirst($gato->sexo) }}
                        <br><strong>Raza:</strong> {{ $gato->raza ?? 'No especificada' }}
                    </p>

                </div>
                <div class="card-footer text-center d-flex justify-content-center gap-2">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
