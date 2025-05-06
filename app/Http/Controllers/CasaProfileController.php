<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Casa;           

class CasaProfileController extends Controller
{

    public function edit()
    {
        $casa = Auth::user();
        $provincias = [
            'Alava' => 'Álava', 'Albacete' => 'Albacete', 'Alicante' => 'Alicante', 'Almeria' => 'Almería',
            'Asturias' => 'Asturias', 'Avila' => 'Ávila', 'Badajoz' => 'Badajoz', 'Barcelona' => 'Barcelona',
            'Burgos' => 'Burgos', 'Caceres' => 'Cáceres', 'Cadiz' => 'Cádiz', 'Cantabria' => 'Cantabria',
            'Castellon' => 'Castellón', 'Ciudad Real' => 'Ciudad Real', 'Cordoba' => 'Córdoba', 'Cuenca' => 'Cuenca',
            'Girona' => 'Girona', 'Granada' => 'Granada', 'Guadalajara' => 'Guadalajara', 'Guipuzcoa' => 'Guipúzcoa',
            'Huelva' => 'Huelva', 'Huesca' => 'Huesca', 'Islas Baleares' => 'Islas Baleares', 'Jaen' => 'Jaén',
            'La Rioja' => 'La Rioja', 'Las Palmas' => 'Las Palmas', 'Leon' => 'León', 'Lerida' => 'Lérida',
            'Lugo' => 'Lugo', 'Madrid' => 'Madrid', 'Malaga' => 'Málaga', 'Murcia' => 'Murcia',
            'Navarra' => 'Navarra', 'Ourense' => 'Ourense', 'Palencia' => 'Palencia', 'Pontevedra' => 'Pontevedra',
            'Salamanca' => 'Salamanca', 'Santa Cruz de Tenerife' => 'Santa Cruz de Tenerife', 'Segovia' => 'Segovia',
            'Sevilla' => 'Sevilla', 'Soria' => 'Soria', 'Tarragona' => 'Tarragona', 'Teruel' => 'Teruel',
            'Toledo' => 'Toledo', 'Valencia' => 'Valencia', 'Valladolid' => 'Valladolid', 'Vizcaya' => 'Vizcaya',
            'Zamora' => 'Zamora', 'Zaragoza' => 'Zaragoza'
        ];
        return view('edit', compact('casa' , 'provincias'));
    }

    public function update(Request $request)
    {
        $casa = Casa::findOrFail(Auth::id());

        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:casas,email,' . $casa->id,
            'telefono'     => 'nullable|string|max:20',
            'descripcion'  => 'nullable|string|max:1000',
            'localizacion' => 'required|string|max:100',
        ]);


        $casa->update($data);

        return redirect()->route('casa.perfil.edit')
                         ->with('success', 'Perfil actualizado correctamente.');
    }
}
