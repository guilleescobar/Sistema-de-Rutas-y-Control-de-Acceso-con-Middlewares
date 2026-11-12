<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     * Comprueba si el usuario autenticado tiene un valor de age igual o superior a 18.
     * Si un menor intenta entrar al casino, debe ser redirigido a su panel de usuario
     * con un mensaje de "Acceso denegado: Debes ser mayor de edad".
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Si no está autenticado, redirigir al login
        if (! Auth::check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder al casino.');
        }

        // 2. Si es menor de 18 años, redirigir a /panel con el mensaje exacto exigido
        if ((int) Auth::user()->age < 18) {
            return redirect('/panel')->with('error', 'Acceso denegado: Debes ser mayor de edad.');
        }

        return $next($request);
    }
}
