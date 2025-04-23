@extends('layout')

@section('title', 'Mensajes Recibidos')

@section('content')
<div class="container mt-5">
    <h2>Mensajes Recibidos</h2>

    @forelse($mensajes as $mensaje)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $mensaje->nombre }} ({{ $mensaje->email }})</h5>
                <p class="card-text"><strong>Mensaje:</strong> {{ $mensaje->mensaje }}</p>
                <p class="card-text"><strong>Gato:</strong> <a href="{{ route('gatos.mostrar', $mensaje->gato_id) }}">{{ $mensaje->gato->nombre }}</a></p>
                <p class="text-muted">Enviado el {{ $mensaje->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    @empty
        <p>No tienes mensajes aún.</p>
    @endforelse
</div>
@endsection
