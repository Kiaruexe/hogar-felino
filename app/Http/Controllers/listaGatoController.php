<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Gato;
use Illuminate\Http\Request;

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
}
