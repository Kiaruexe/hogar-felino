@extends('layout')

@section('title', 'Lista de Gatos')

@section('css')
@endsection

@section('content')
@if(Auth::check())
    <div class="row">
        @if(Auth::user()->rol === 'casa')
            <aside class="col-md-2 mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        Panel Casa
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('contacto.recibidos') }}" class="list-group-item list-group-item-action">
                            Mensajes Recibidos
                        </a>
                        <a href="{{ route('gatos.registro') }}" class="list-group-item list-group-item-action">
                            Crear Gato
                        </a>
                    </div>
                </div>
            </aside>
            <main class="col-md-10">
        @else
            <main class="col-12">
        @endif

            <h1 class="text-center mb-4">Listado de Gatos</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($gatos as $gato)
                    <div class="col">
                        <div class="card h-100">
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
            <div class="d-flex justify-content-center my-4">
                {{ $gatos->links() }}
              </div>
        </main>
    </div>
@else
    <div class="alert alert-info text-center">
        Debes iniciar sesión para ver los gatos.
    </div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
