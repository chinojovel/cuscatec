<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'seller') {
            return $next($request);
        }

        return redirect()->route('ecommerce.seller.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Verificar credenciales y rol de cliente
        if (Auth::attempt(array_merge($credentials, ['role' => 'seller']))) {
            return redirect()->route('ecommerce');
        }

        return back()->withErrors(['email' => 'Invalid credentials or not a seller']);
    }
}
