<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.registro');
    }

    public function registro(Request $r)
{

    $r->validate([
        'nombre'      => 'required|string|max:255',
        'email'       => 'required|string|email|max:255|unique:casas',
        'password'  => 'required|string|min:6|confirmed', // Debe haber un campo contraseña_confirmation en el formulario
        'telefono'    => 'nullable|string|max:20',
        'descripcion' => 'nullable|string',
    ]);

    // Crear la casa de acogida con los datos validados
    $casaAcogida = new Casa();
    $casaAcogida->  nombre  = $r->nombre;
    $casaAcogida->  email   = $r->email;
    $casaAcogida-> password = Hash::make($r->password); // Encriptamos la contraseña
    $casaAcogida->  telefono = $r->telefono;
    $casaAcogida->  descripcion = $r->descripcion;
    $casaAcogida->  fechaRegistro = now();
    $casaAcogida->  estadoCuenta = 'activo';
    $casaAcogida->  rol = 'casa';
    $casaAcogida->save();
     

    // Aquí podrías iniciar sesión al usuario automáticamente:
     Auth::login($casaAcogida);

    // Redirigir a la ruta deseada con un mensaje de éxito
    return redirect(route('login.casa'))->with('status', 'Registro exitoso');
}
public function showLogin()
{
    return view('auth.login');
}


public function login(Request $r)
{
    $r->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $r->only('email', 'password');
    $remember = $r->has('remember');

    if (Auth::guard('casa')->attempt($credentials, $remember)) {
        $r->session()->regenerate();
        return redirect()->intended('casa'); // Asegúrate de que la ruta 'casa' exista.
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas.']);
}

public function logout(Request $r)
{
    Auth::logout();
    $r->session()->invalidate();
    $r->session()->regenerateToken();

    return redirect(route('login.casa'));
}
}
