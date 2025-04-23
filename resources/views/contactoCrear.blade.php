@extends('layout')

@section('title', 'Contactar con la Casa de Acogida')

@section('content')
<div class="container mt-5">
    <h2>Contactar sobre: {{ $gato->nombre }}</h2>
    <form action="{{ route('contacto.enviar', $gato) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Tu nombre</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Tu email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" name="mensaje" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar mensaje</button>
    </form>
</div>
@endsection
