@extends('layout')

@section('title', 'Registro de Gato')

@section('css')
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Registro de Gato</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('gato.registro') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Gato</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="edad" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="edad" name="edad" value="{{ old('edad') }}" required>
            @error('edad')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select" id="sexo" name="sexo" required>
                <option value="">Seleccione...</option>
                <option value="macho" {{ old('sexo')=='macho' ? 'selected' : '' }}>Macho</option>
                <option value="hembra" {{ old('sexo')=='hembra' ? 'selected' : '' }}>Hembra</option>
            </select>
            @error('sexo')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <select class="form-select" id="raza" name="raza">
                <option value="">Seleccione la raza...</option>
                @php
                    $razas = [
                        'Común Europeo', 'Balinés', 'Peterbald', 'Siamés', 'Oriental',
                        'Bengalí', 'Ocicat', 'Manx', 'Van Turco', 'Snowshoe',
                        'Savannah', 'American Curl', 'British Shorthair', 'Scottish Fold',
                        'Ragdoll', 'Selkirk Rex', 'Persa', 'Egipcio', 'Maine Coon', 'Siberiano', 'Angora'
                    ];
                @endphp
                @foreach($razas as $razaOption)
                    <option value="{{ $razaOption }}" {{ old('raza') === $razaOption ? 'selected' : '' }}>
                        {{ $razaOption }}
                    </option>
                @endforeach
            </select>
            @error('raza')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            @error('descripcion')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (máx. 40KB)</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            @error('imagen')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <input type="hidden" name="casa_acogida_id" value="{{ Auth::user()->id ?? '' }}">

        <button type="submit" class="btn btn-primary w-100">Registrar Gato</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection