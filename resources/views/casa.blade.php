@extends('layout')

@section('title', 'Inicio')

@section('css')
<!-- Puedes añadir CSS específico aquí si hace falta -->
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::check())
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('gatos.registro') }}" class="btn btn-primary me-2">
                Registrar Gato
            </a>
            <a href="{{ route('gatos.lista') }}" class="btn btn-primary me-2">
                Lista Gato
            </a>
            <form action="{{ route('logout.casa') }}" method="POST" onsubmit="return confirm('¿Estás seguro de salir?');">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>
        </div>
    @endif

    <h1 class="text-center">Bienvenido a Casas de Acogida</h1>
@endsection

@section('scripts')
<!-- Scripts específicos si los necesitas -->
@endsection
