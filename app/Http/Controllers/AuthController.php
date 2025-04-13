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
        'password'  => 'required|string|min:6|confirmed', 
        'telefono'    => 'nullable|string|max:20',
        'descripcion' => 'nullable|string',
    ]);

    $casaAcogida = new Casa();
    $casaAcogida->  nombre  = $r->nombre;
    $casaAcogida->  email   = $r->email;
    $casaAcogida-> password = Hash::make($r->password);
    $casaAcogida->  telefono = $r->telefono;
    $casaAcogida->  descripcion = $r->descripcion;
    $casaAcogida->  fechaRegistro = now();
    $casaAcogida->  estadoCuenta = 'activo';
    $casaAcogida->  localizacion = $r->localizacion; 
    $casaAcogida->  rol = 'casa';
    $casaAcogida->save();
     
     Auth::login($casaAcogida);

    return redirect(route('login'))->with('status', 'Registro exitoso');
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

    // Intentar autenticarse usando el guard "casa"
    if (Auth::guard('casa')->attempt($credentials, $remember)) {
        $r->session()->regenerate();
    
        
        // Verificar el rol del usuario y redirigir en consecuencia
        if (Auth::guard('casa')->user()->rol === 'admin') {
            return redirect()->route('admin.index'); // Ruta para la zona de administración
        } else {
            return redirect()->route('casa'); // Ruta para la casa de acogida
        }
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas.'])->withInput();
}

public function logout(Request $r)
{
    Auth::logout();
    $r->session()->invalidate();
    $r->session()->regenerateToken();

    return redirect(route('login'));
}
}
