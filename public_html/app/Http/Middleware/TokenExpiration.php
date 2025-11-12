<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class TokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        // Obtener el token del encabezado de autorización
        $token = $request->bearerToken();

        if ($token) {
            // Buscar el token en la base de datos
            $accessToken = PersonalAccessToken::findToken($token);

            // Verificar si el token existe y si su fecha de creación es mayor a 24 horas
            if ($accessToken && $accessToken->created_at->lt(Carbon::now()->subDay())) {
                return response()->json(['message' => 'Token expired'], 401);
            }
        }

        return $next($request);
    }
}
