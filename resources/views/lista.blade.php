@extends('layout')

@section('title', 'Adopción de Gatos')

@section('content')
    <div class="header-banner py-5 text-center text-white" style="background-color: #006d77;">
        <div class="container">
            <h1>Gatos Adultos en Adopción</h1>
            <p>Encuentra el compañero perfecto y dale una segunda oportunidad</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($gatos as $gato)
                <div class="col">
                    <div class="card h-100 shadow-sm">
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
                                        $diff = \Carbon\Carbon::parse($gato->edad)->diff(now());
                                    @endphp
                                    <strong>Edad:</strong> {{ $diff->y }} {{ $diff->y == 1 ? 'año' : 'años' }}
                                    @if($diff->m > 0) y {{ $diff->m }} {{ $diff->m == 1 ? 'mes' : 'meses' }}@endif
                                    <br>
                                @endif
                                <strong>Sexo:</strong> {{ ucfirst($gato->sexo) }}<br>
                                <strong>Raza:</strong> {{ $gato->raza ?? 'No especificada' }}
                            </p>
                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ route('gatos.mostrar', $gato->id) }}" class="btn btn-primary btn-sm">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Enlaces de paginación --}}
<div class="d-flex justify-content-center my-4">
    {{ $gatos->links() }}
  </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
