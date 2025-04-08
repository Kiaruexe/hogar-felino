<?php

namespace App\Http\Controllers;

use App\Models\Gato;
use Illuminate\Http\Request;

class RegistroGatoController extends Controller
{
    public function index()
    {
        return view('registroGato');
    }



    public function registro(Request $r)
    {
        $r->validate([
            'nombre'          => 'required|string|max:255',
            'edad'            => 'required|numeric',
            'sexo'            => 'required|in:macho,hembra',
            'descripcion'     => 'nullable|string',
            'imagen'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'casa_acogida_id' => 'required|exists:casas,id',   
         ]);
    
        $gato = new Gato();
        $gato->nombre = $r->nombre;
        $gato->edad = $r->edad;
        $gato->sexo = $r->sexo;
        $gato->descripcion = $r->descripcion;
    
        // Si se sube una imagen, la convertimos a binario
        if ($r->hasFile('imagen')) {
            // Obtener la ruta temporal y leer su contenido en binario
            $gato->imagen = file_get_contents($r->file('imagen')->getRealPath());
        } else {
            $gato->imagen = null;
        }
    
        $gato->casa_acogida_id = $r->casa_acogida_id;
        $gato->save();
    
        return redirect(route('casa'))->with('status', 'Registro exitoso');
    }
}
