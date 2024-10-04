<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('estudiantes')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }

        // Check if the user has the required permission
        if (!auth()->user()->can($permission)) {
            return redirect()->route('estudiantes')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        return $next($request);
    }
}
