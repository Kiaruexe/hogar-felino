<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Gato;
use Illuminate\Http\Request;

class AdminGatoController extends Controller
{
    public function index(Request $request)
    {
        $query = Gato::query();

        // Puedes agregar filtros adicionales según sea necesario:
        if ($request->filled('buscar')) {
            $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
        }
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->filled('raza')) {
            $query->where('raza', 'LIKE', '%' . $request->raza . '%');
        }
        if ($request->filled('localizacion')) {
            $query->whereHas('casaAcogida', function($q) use ($request) {
                $q->where('localizacion', $request->localizacion);
            });
        }

        $gatos = $query->get();

        return view('adminGatos', compact('gatos'));
    }

    // Muestra los detalles de un gato (opcional, para admin)
    public function show($id)
    {
        $gato = Gato::findOrFail($id);
        return view('adminGatos', compact('gato'));
    }

    // Muestra el formulario de edición para un gato
    public function edit($id)
    {
        $gato = Gato::findOrFail($id);
        $casas = Casa::all(); // Si necesitas mostrar casas para seleccionar
        return view('editarGatos', compact('gato', 'casas'));
    }

    // Actualiza la información de un gato
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'edad'        => 'required|date',
            'raza'        => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'sexo'        => 'required|in:macho,hembra',
        ]);

        $gato = Gato::findOrFail($id);
        $gato->update($request->only('nombre', 'edad', 'raza', 'descripcion', 'sexo'));

        return redirect()->route('admin.gatos.index')->with('success', 'Gato actualizado correctamente.');
    }

    // Elimina un gato
    public function destroy($id)
    {
        $gato = Gato::findOrFail($id);
        $gato->delete();
        return redirect()->route('admin.gatos.index')->with('success', 'Gato eliminado correctamente.');
    }
}
