<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Gato</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Modificar Gato</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('gatos.update', $gato->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $gato->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="edad" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="edad" name="edad" value="{{ old('edad', $gato->edad) }}" required>
        </div>

        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <select class="form-select" id="raza" name="raza">
                <option value="">Seleccione la raza...</option>
                @php
                    $razas = [
                        'Común Europeo', 
                        'Balinés', 
                        'Peterbald', 
                        'Siamés',
                        'Oriental',
                        'Bengalí',
                        'Ocicat',
                        'Manx',
                        'Van Turco',
                        'Snowshoe',
                        'Savannah',
                        'American Curl',
                        'British Shorthair',
                        'Scottish Fold',
                        'Ragdoll',
                        'Selkirk Rex',
                        'Persa',
                        'Egipcio',
                        'Maine Coon',
                        'Siberiano',
                        'Angora'
                    ];
                @endphp
                @foreach($razas as $razaOption)
                    <option value="{{ $razaOption }}"
                        {{ old('raza') === $razaOption ? 'selected' : '' }}>
                        {{ $razaOption }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $gato->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="casa_acogida_id" class="form-label">Casa de Acogida</label>
            <select class="form-select" id="casa_acogida_id" name="casa_acogida_id" required>
                @foreach ($casas as $casa)
                    <option value="{{ $casa->id }}" {{ old('casa_acogida_id', $gato->casa_acogida_id) == $casa->id ? 'selected' : '' }}>
                        {{ $casa->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
