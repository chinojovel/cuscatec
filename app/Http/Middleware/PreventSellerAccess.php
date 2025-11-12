<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PreventSellerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario es vendedor
        if (Auth::check() && Auth::user()->role === 'seller' ) {
            // Redirigir a una página específica o mostrar un mensaje
            throw new HttpException(403, 'Sellers cannot access this page.');
        }

        if (Auth::check() && Auth::user()->role === 'customer' ) {
            // Redirigir a una página específica o mostrar un mensaje
            throw new HttpException(403, 'Customers cannot access this page.');
        }

        return $next($request);
    }
}
