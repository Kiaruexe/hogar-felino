<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica que el usuario esté autenticado y sea admin
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            // Puedes cambiar el mensaje o redirigir a otra página
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
