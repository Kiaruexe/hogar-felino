@extends('layout')

@section('title', 'Registro de Casa de Acogida')

@section('css')
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Registro de Casa de Acogida</h2>

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

    <form method="POST" action="{{ route('registro') }}">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o Razón Social</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
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
                    <option value="{{ $clave }}" {{ old('localizacion') == $clave ? 'selected' : '' }}>{{ $valor }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        <br><br><br>
    </form>
</div>
@endsection

@section('scripts')
@endsection
