<?php

namespace App\Http\Controllers;

use App\Models\Gato;
use App\Models\MensajeContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MensajeContactoController extends Controller
{
   
        public function crear(Gato $gato)
        {
            return view('contactoCrear', compact('gato'));
        }
    
        public function enviar(Request $request, Gato $gato)
        {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mensaje' => 'required|string',
            ]);
    
            MensajeContacto::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'mensaje' => $request->mensaje,
                'gato_id' => $gato->id,
            ]);
    
            return redirect()->route('gatos.mostrar', $gato->id)->with('success', 'Mensaje enviado correctamente.');
        }
    
        public function verParaCasa()
        {
            $casaId = Auth::id();
    
            $mensajes = MensajeContacto::with('gato')
                ->whereHas('gato', function($q) use ($casaId) {
                    $q->where('casa_acogida_id', $casaId);
                })
                ->latest()
                ->get();
        
            return view('contactoRecibidos', compact('mensajes'));
        }
    }

