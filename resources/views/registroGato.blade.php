@extends('layout')

@section('title', 'Registro de Gato')

@section('content')
<div class="container mt-5">
    <h2>Registro de Gato</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Se usa multipart/form-data para subir la imagen -->
    <form action="{{ route('gato.registro') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Gato</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="edad" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="edad" name="edad" required>
        </div>

        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select" id="sexo" name="sexo" required>
                <option value="">Seleccione...</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>

        <input type="hidden" name="casa_acogida_id" value="{{ Auth::user()->id ?? '' }}">

        <button type="submit" class="btn btn-primary">Registrar Gato</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
