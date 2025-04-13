<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Gato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class listaGatoController extends Controller
{
    public function index()
    {
        $gatos = Gato::all();
        return view('lista', ['gatos' => $gatos]);
    }

    public function mostrar($id)
    {
        $gato = Gato::findOrFail($id);
        return view('mostrarGato', compact('gato'));
    }

    public function home(Request $r)
    {
        $query = Gato::query();
    
        // Filtrar por sexo
        if ($r->filled('sexo')) {
            $query->where('sexo', $r->sexo);
        }
    
        // Filtrar por raza (campo en la tabla gatos)
        if ($r->filled('raza')) {
            $query->where('raza', $r->raza);
        }
    
        // Filtrar por localización (campo en la tabla casas, a través de la relación)
        if ($r->filled('localizacion')) {
            $query->whereHas('casaAcogida', function ($q) use ($r) {
                $q->where('localizacion', $r->localizacion);
            });
        }
    
        $gatos = $query->get();
        return view('index', ['gatos' => $gatos]);
    }

    public function edit($id)
    {
        $gato = Gato::findOrFail($id);
        $casas = Casa::all();
        $casa = Auth::user(); // Llamada correcta mediante el Facade
    
        if ($casa->rol !== 'admin' && $gato->casa_acogida_id !== $casa->id) {
            abort(403, 'No tienes permiso para modificar este gato.');
        }
    
        return view('editarGatos', compact('gato', 'casas'));
    }


    // Método para procesar la actualización (update)
    public function update(Request $request, $id)
{
    $gato = Gato::findOrFail($id);

    // Obtener el usuario autenticado
    $usuario = Auth::user();

    // Si el usuario no es admin y el gato no pertenece a su casa, se aborta la operación
    if ($usuario->rol !== 'admin' && $gato->casa_acogida_id !== $usuario->id) {
        abort(403, 'No tienes permiso para modificar este gato.');
    }

    $request->validate([
        'nombre'          => 'required|string|max:255',
        'edad'            => 'required|date',
        'raza'            => 'nullable|string|max:255',
        'descripcion'     => 'nullable|string',
        'casa_acogida_id' => 'required|exists:casas,id',
    ]);

    $gato->nombre = $request->nombre;
    $gato->edad = $request->edad; 
    $gato->raza = $request->raza;
    $gato->descripcion = $request->descripcion;
    $gato->casa_acogida_id = $request->casa_acogida_id;
    $gato->save();

    return redirect()->route('gatos.lista')->with('status', 'Gato actualizado correctamente.');
}


    public function casa()
    {
        // Obtener la casa autenticada usando el guard "casa"
        $casa = auth()->guard('casa')->user();
        
        // Filtrar los gatos que pertenecen a esta casa
        $gatos = Gato::where('casa_acogida_id', $casa->id)->get();
    
        return view('casa', compact('gatos'));
    }
    
    public function destroy($id)
{
    $gato = Gato::findOrFail($id);

    if ($gato->casa_acogida_id !== Auth::id()) {
        abort(403, 'No tienes permiso para eliminar este gato.');
    }

    $gato->delete();

    return redirect()->route('gatos.lista')->with('success', 'Gato eliminado correctamente.');
}
    
}

