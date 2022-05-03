<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validacionRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->rol_id == 1) {
            
            return $next($request);
        }
        else{
            alert()->warning('Acceso Denegado', 'No Puedes Ingresar Sin El Rol Administrador');
            return back();
        }
    }
}
