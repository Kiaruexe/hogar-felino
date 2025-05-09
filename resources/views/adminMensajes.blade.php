@extends('layout')

@section('title', 'Mensajes Recibidos')

@section('content')
<div class="container mt-5">
  <h1 class="mb-4">Mensajes de Contacto</h1>

  @if($mensajes->count())
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Remitente</th>
        <th>Email</th>
        <th>Mensaje</th>
        <th>Gato</th>
        <th>Casa destino</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mensajes as $msg)
        <tr>
          <td>{{ $msg->id }}</td>
          <td>{{ $msg->nombre }}</td>
          <td>{{ $msg->email }}</td>
          <td>{{ Str::limit($msg->mensaje) }}</td>
          <td>{{ $msg->gato->nombre }}</td>
          <td>{{ $msg->gato->casaAcogida->nombre }}</td>
          <td class="text-center">
            <form 
              action="{{ route('admin.mensajes.destroy', $msg->id) }}"
              method="POST"
              onsubmit="return confirm('¿Eliminar este mensaje?');"
              style="display:inline"
            >
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">
                Eliminar
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
      {{ $mensajes->links() }}
    </div>

  @else
    <div class="alert alert-info">
      No hay mensajes registrados.
    </div>
  @endif
</div>
@endsection
