@extends('layout')

@section('title', 'Lista de Gatos')

@section('css')
<!-- Puedes agregar estilos adicionales específicos para esta vista aquí -->
@endsection

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::check())

        <h1 class="text-center mb-4">Listado de Gatos</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($gatos as $gato)
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
                            <a href="{{ route('gatos.edit', $gato->id) }}" class="btn btn-warning btn-sm">Modificar</a>
                            <form action="{{ route('gatos.destroy', $gato->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este gato?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Debes iniciar sesión para ver los gatos.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
