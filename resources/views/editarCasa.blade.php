{{-- resources/views/auth/edit.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Casa de Acogida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Modificar Casa de Acogida</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Asegúrate de actualizar la acción al endpoint correcto para la modificación, por ejemplo: --}}
    <form method="POST" action="{{ route('admin.casas.update', $casa->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o Razón Social</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $casa->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $casa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $casa->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $casa->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="localizacion" class="form-label">Localización</label>
            <select class="form-select" id="localizacion" name="localizacion" required>
                <option value="">Seleccione la provincia...</option>
                @php
                    $provincias = [
                        'Alava' => 'Álava', 'Albacete' => 'Albacete', 'Alicante' => 'Alicante', 'Almeria' => 'Almería',
                        'Asturias' => 'Asturias', 'Avila' => 'Ávila', 'Badajoz' => 'Badajoz', 'Barcelona' => 'Barcelona',
                        'Burgos' => 'Burgos', 'Caceres' => 'Cáceres', 'Cadiz' => 'Cádiz', 'Cantabria' => 'Cantabria',
                        'Castellon' => 'Castellón', 'Ciudad Real' => 'Ciudad Real', 'Cordoba' => 'Córdoba', 'Cuenca' => 'Cuenca',
                        'Girona' => 'Girona', 'Granada' => 'Granada', 'Guadalajara' => 'Guadalajara', 'Guipuzcoa' => 'Guipúzcoa',
                        'Huelva' => 'Huelva', 'Huesca' => 'Huesca', 'Islas Baleares' => 'Islas Baleares', 'Jaen' => 'Jaén',
                        'La Rioja' => 'La Rioja', 'Las Palmas' => 'Las Palmas', 'Leon' => 'León', 'Lerida' => 'Lérida',
                        'Lugo' => 'Lugo', 'Madrid' => 'Madrid', 'Malaga' => 'Málaga', 'Murcia' => 'Murcia',
                        'Navarra' => 'Navarra', 'Ourense' => 'Ourense', 'Palencia' => 'Palencia', 'Pontevedra' => 'Pontevedra',
                        'Salamanca' => 'Salamanca', 'Santa Cruz de Tenerife' => 'Santa Cruz de Tenerife', 'Segovia' => 'Segovia',
                        'Sevilla' => 'Sevilla', 'Soria' => 'Soria', 'Tarragona' => 'Tarragona', 'Teruel' => 'Teruel',
                        'Toledo' => 'Toledo', 'Valencia' => 'Valencia', 'Valladolid' => 'Valladolid', 'Vizcaya' => 'Vizcaya',
                        'Zamora' => 'Zamora', 'Zaragoza' => 'Zaragoza'
                    ];
                @endphp
                @foreach($provincias as $clave => $valor)
                    <option value="{{ $clave }}" {{ old('localizacion', $casa->localizacion) == $clave ? 'selected' : '' }}>{{ $valor }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Actualizar Casa</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
