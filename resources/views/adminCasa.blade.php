@extends('layout')

@section('title', 'Panel Admin - Lista de Casas de Acogida')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Administración de Casas de Acogida</h1>

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
                <th>Email</th>
                <th>Teléfono</th>
                <th>Localización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($casas as $casa)
                <tr>
                    <td>{{ $casa->id }}</td>
                    <td>{{ $casa->nombre }}</td>
                    <td>{{ $casa->email }}</td>
                    <td>{{ $casa->telefono }}</td>
                    <td>{{ $casa->localizacion }}</td>
                    <td>
                        <a href="{{ route('admin.casas.edit', $casa->id) }}" class="btn btn-warning btn-sm">Modificar</a>
                        <a href="{{ route('admin.casas.show', $casa->id) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <form action="{{ route('admin.casas.destroy', $casa->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('¿Estás seguro de eliminar esta casa?');">
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
