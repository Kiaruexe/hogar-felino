<?php

namespace App\Http\Controllers;

use App\Models\MensajeContacto;
use Illuminate\Http\Request;

class AdminMensajeController extends Controller
{
    public function mensajesIndex()
    {
        // Carga mensajes paginados con sus relaciones
        $mensajes = MensajeContacto::with('gato.casaAcogida')
                           ->paginate(20);

        return view('adminMensajes', compact('mensajes'));
    }

    public function destroyMensaje($id)
    {
        $mensaje = MensajeContacto::findOrFail($id);
        $mensaje->delete();

        return redirect()
            ->route('admin.mensajes.index')
            ->with('success', 'Mensaje eliminado correctamente.');
    }
    
}
