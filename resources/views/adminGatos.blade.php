@extends('layout')

@section('title', 'Panel Admin - Lista de Gatos')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Administración de Gatos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Raza</th>
                <th>Nacimiento</th>
                <th>Casa de Acogida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gatos as $gato)
                <tr>
                    <td>{{ $gato->id }}</td>
                    <td>{{ $gato->nombre }}</td>
                    <td>{{ $gato->raza ?? 'No especificada' }}</td>
                    <td>{{ $gato->edad ? \Carbon\Carbon::parse($gato->edad)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $gato->casaAcogida->nombre ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.gatos.edit', $gato->id) }}" class="btn btn-warning btn-sm">Modificar</a>
                        <a href="{{ route('admin.gatos.show', $gato->id) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <form action="{{ route('admin.gatos.destroy', $gato->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este gato?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
