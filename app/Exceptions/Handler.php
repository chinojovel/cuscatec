<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Handle unauthenticated users for API and web requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Si la solicitud espera JSON, retornamos un error 401 en lugar de redirigir
        // Verificamos si la solicitud es para una ruta de la API (usualmente prefijadas con /api)
        if ($request->is('api/*')) {
            // Forzamos que la respuesta sea en JSON, incluso si no envió el encabezado Accept: application/json
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Comportamiento por defecto para solicitudes no API (redirección al login)
        return redirect()->guest(route('login'));
    }
}
