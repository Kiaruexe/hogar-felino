@extends('layout')

@section('title', 'Login Casa de Acogida')

@section('css')
@endsection

@section('content')
<div class="container mt-5">
    <h2>Login Casa de Acogida</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   required>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox"
                   class="form-check-input"
                   id="remember"
                   name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Recordarme</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>
</div>
@endsection

@section('scripts')
@endsection
