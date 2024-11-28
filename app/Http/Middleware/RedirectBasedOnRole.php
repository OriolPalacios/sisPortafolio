<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Access session data
        $sessionData = $request->session()->all();
        // Access 'current_role' attribute from session data
        $currentRole = $request->session()->get('current_role');
        \Log::info('Role from session: ' . $currentRole);
        if ($currentRole == 'Administrador') {
            return redirect('Administrador');
        } elseif ($currentRole == 'Revisor') {
            return redirect('Revisor');
        } elseif ($currentRole == 'Docente') {
            return redirect('Docente');
        }
        return $next($request);
    }
}
