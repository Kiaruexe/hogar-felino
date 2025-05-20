<?php

namespace App\Http\Controllers;

use App\Models\Gato;
use App\Models\Casa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ListaGatoController extends Controller
{

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

        // Filtrar por raza
        if ($r->filled('raza')) {
            $query->where('raza', $r->raza);
        }

        // Filtrar por localización
        if ($r->filled('localizacion')) {
            $query->whereHas('casaAcogida', function ($q) use ($r) {
                $q->where('localizacion', $r->localizacion);
            });
        }

        // Cambiamos get() por paginate(12)
        $gatos = $query->paginate(12)->appends($r->query());

        return view('index', compact('gatos'));
    }

    public function edit($id)
    {
        $gato = Gato::findOrFail($id);
        $casas = Casa::all();
        $casa  = Auth::user();

        if ($casa->rol !== 'admin' && $gato->casa_acogida_id !== $casa->id) {
            abort(403, 'No tienes permiso para modificar este gato.');
        }

        return view('editarGatos', compact('gato', 'casas'));
    }

    public function update(Request $request, $id)
    {
        $gato = Gato::findOrFail($id);
        $usuario = Auth::user();
    
        if ($usuario->rol !== 'admin' && $gato->casa_acogida_id !== $usuario->id) {
            abort(403, 'No tienes permiso para modificar este gato.');
        }
    
        // 1) Validación: ahora incluye imagen
        $request->validate([
            'nombre'          => 'required|string|max:255',
            'edad'            => 'required|date',
            'raza'            => 'nullable|string|max:255',
            'descripcion'     => 'nullable|string',
            'casa_acogida_id' => 'required|exists:casas,id',
            'imagen'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // 2) Asignación de campos habituales
        $gato->nombre          = $request->nombre;
        $gato->edad            = $request->edad;
        $gato->raza            = $request->raza;
        $gato->descripcion     = $request->descripcion;
        $gato->casa_acogida_id = $request->casa_acogida_id;
    
        // 3) Si llega un archivo, lo leemos y guardamos como BLOB
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $gato->imagen = file_get_contents($file->getRealPath());
        }
    
        $gato->save();
    
        return redirect()->route('casa')
                         ->with('status', 'Gato actualizado correctamente.');
    }
    

    public function casa()
    {
        $casa = auth()->guard('casa')->user();

        $gatos = Gato::where('casa_acogida_id', $casa->id)
                     ->paginate(12);

        return view('casa', compact('gatos'));
    }

    public function destroy($id)
    {
        $gato = Gato::findOrFail($id);

        if ($gato->casa_acogida_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este gato.');
        }

        $gato->delete();

        return redirect()->route('casa')
                         ->with('success', 'Gato eliminado correctamente.');
    }
}

