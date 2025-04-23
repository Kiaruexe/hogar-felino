@extends('layout')

@section('title', 'Detalle del Gato - ' . $gato->nombre)

@section('content')
<div class="container mt-5">
    <a href="{{ route('gatos.lista') }}" class="btn btn-secondary mb-3">« Volver al listado</a>
    <div class="card mx-auto" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-5 text-center p-3">
                @if ($gato->imagen)
                    <img src="data:image/jpeg;base64,{{ base64_encode($gato->imagen) }}" 
                         alt="Imagen de {{ $gato->nombre }}" class="img-fluid rounded">
                @else
                    <img src="https://via.placeholder.com/400x300?text=Sin+Imagen" 
                         alt="Sin imagen" class="img-fluid rounded">
                @endif
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title">{{ $gato->nombre }}</h3>
                    <p class="card-text"><strong>Descripción:</strong> {{ $gato->descripcion }}</p>
                    <p class="card-text"><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($gato->edad)->format('d/m/Y') }}</p>
                    @php
                        $diff = \Carbon\Carbon::parse($gato->edad)->diff(\Carbon\Carbon::now());
                    @endphp
                    <p class="card-text"><strong>Edad:</strong> 
                        {{ $diff->y }} {{ $diff->y == 1 ? 'año' : 'años' }} 
                        y {{ $diff->m }} {{ $diff->m == 1 ? 'mes' : 'meses' }}
                    </p>
                    <p class="card-text"><strong>Sexo:</strong> {{ ucfirst($gato->sexo) }}</p>
                    <p class="card-text"><strong>Raza:</strong> {{ $gato->raza ?? 'No especificada' }}</p>

                    @if ($gato->casaAcogida)
                        <hr>
                        <h5 class="mt-3">Casa de Acogida</h5>
                        <p class="mb-1"><strong>Nombre:</strong> {{ $gato->casaAcogida->nombre }}</p>
                        <p class="mb-1"><strong>Teléfono:</strong> {{ $gato->casaAcogida->telefono }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $gato->casaAcogida->email }}</p>
                        <p class="mb-3"><strong>Localización:</strong> {{ $gato->casaAcogida->localizacion }}</p>
                        <div class="text-center">
                            <a href="{{ route('contacto.crear', $gato->casaAcogida->id) }}" 
                               class="btn btn-success btn-lg">Contactar con la Casa</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection