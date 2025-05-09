@extends('layout')

@section('title', 'Inicio')

@section('css')

<style>
    .home-links {
        margin-top: 3rem;
    }
    .home-links .btn {
        padding: 1rem 2rem;
        font-size: 1.25rem;
    }
</style>
@endsection

@section('content')
<div class="container text-center mt-5">
    <h1>Bienvenido a la Aplicación de Casas y Gatos</h1>
    <p class="lead">Elige una de las opciones para gestionar casas de acogida o ver gatos en adopción.</p>

    <div class="row home-links justify-content-center mt-4">
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.casas.index') }}" class="btn btn-primary w-100">Panel de Casas de Acogida</a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.gatos.index') }}" class="btn btn-secondary w-100">Panel de gatos</a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.mensajes.index') }}" class="btn btn-success w-100">  Ver Mensajes recibidos </a>
          </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
