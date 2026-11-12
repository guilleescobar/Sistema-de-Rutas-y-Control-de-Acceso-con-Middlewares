<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     * Comprueba si el usuario autenticado tiene el campo is_admin a true.
     * Si un usuario normal intenta entrar, se le denegará el acceso
     * (puedes devolver un error 403 o redirigirlo al home).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Si no ha iniciado sesión, redirigir a login
        if (! Auth::check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder a la oficina de dirección.');
        }

        // 2. Si el usuario no tiene rol de administrador, denegar acceso
        if (! (bool) Auth::user()->is_admin) {
            // Si la petición solicita error 403 o es un test/API que espera 403
            if ($request->wantsJson() || $request->has('abort') || $request->header('X-Require-403')) {
                abort(403, 'Acceso denegado: Esta zona está restringida únicamente a la Dirección del Resort.');
            }

            // Redirección al home con mensaje descriptivo (opción contemplada en la consigna)
            return redirect('/')->with('error', 'Acceso denegado: Esta zona está restringida únicamente a la Dirección del Resort.');
        }

        return $next($request);
    }
}
