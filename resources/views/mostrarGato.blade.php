@extends('layout')

@section('title', 'Detalle del Gato - ' . $gato->nombre)

@section('content')
<div class="container mt-5">
    <a href="{{ route('gatos.lista') }}" class="btn btn-secondary mb-3">« Volver al listado</a>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="img-container">
                    @if ($gato->imagen)
                        <img src="data:image/jpeg;base64,{{ base64_encode($gato->imagen) }}" 
                             alt="Imagen de {{ $gato->nombre }}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sin+Imagen" 
                             alt="Sin imagen" class="img-fluid">
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">{{ $gato->nombre }}</h3>
                    <p class="card-text"><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($gato->edad)->format('d/m/Y') }}</p>
                    <p class="card-text"><strong>Edad:</strong> {{ $gato->edad_en_anios }} años</p>
                    <p class="card-text"><strong>Sexo:</strong> {{ ucfirst($gato->sexo) }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $gato->descripcion }}</p>
                    
                    @if ($gato->casaAcogida)
                        <p class="card-text"><strong>Nombre de la Casa de Acogida:</strong> {{ $gato->casaAcogida->nombre }}</p>
                        <p class="card-text"><strong>Teléfono:</strong> {{ $gato->casaAcogida->telefono }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $gato->casaAcogida->email }}</p>
                    @else
                        <p class="card-text text-muted">No hay información de la casa de acogida.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
