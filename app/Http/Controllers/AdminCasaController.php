<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Gato;
use Illuminate\Http\Request;

class AdminCasaController extends Controller
{
    
    public function indexAdmin()
    {
        $casas = Casa::all();
        $gatos = Gato::all();
        return view('indexAdmin', compact('casas', 'gatos'));
    }

    public function index()
    {
        $casas = Casa::all();
        return view('adminCasa', compact('casas'));
    }

    // Muestra los detalles de una casa 
    public function show($id)
    {
        $casa = Casa::findOrFail($id);
        return view('adminCasa', compact('casa'));
    }

    // Muestra el formulario de edición para una casa
    public function edit($id)
    {
        $casa = Casa::findOrFail($id);
        return view('editarCasa', compact('casa'));
    }

    // Actualiza la información de una casa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:casas,email,' . $id,
            'telefono'    => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
            'localizacion'=> 'required', // Si es un enum, la validación lo puede ser también
        ]);

        $casa = Casa::findOrFail($id);
        $casa->update($request->only('nombre', 'email', 'telefono', 'descripcion', 'localizacion'));

        return redirect()->route('admin.casas.index')->with('success', 'Casa actualizada correctamente.');
    }

    // Elimina una casa de acogida
    public function destroy($id)
    {
        $casa = Casa::findOrFail($id);
        $casa->delete();
        return redirect()->route('admin.casas.index')->with('success', 'Casa eliminada correctamente.');
    }
}
