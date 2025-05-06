@extends('layout')

@section('title', 'Mi Perfil - Casa de Acogida')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Mi Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul></div>
    @endif

    <form action="{{ route('casa.perfil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o Razón Social</label>
            <input type="text" id="nombre" name="nombre" class="form-control" 
                   value="{{ old('nombre', $casa->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ old('email', $casa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" 
                   value="{{ old('telefono', $casa->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="4">{{ old('descripcion', $casa->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <select id="localizacion" name="localizacion" class="form-select" required>
                <option value="">Seleccione la provincia...</option>
                @foreach($provincias as $clave => $valor)
                    <option value="{{ $clave }}"
                        {{ old('localizacion', $casa->localizacion) == $clave ? 'selected' : '' }}>
                        {{ $valor }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
