<?php

namespace App\Http\Controllers\Eco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EcoHomeController extends Controller
{
    // Método para mostrar la vista de login
    public function showLoginForm()
    {
        return view('ecommerce.auth.eco-login'); // Asegúrate de tener una vista llamada `eco/login.blade.php`
    }

    // Método para procesar el login
    public function login(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Si la autenticación es exitosa, redirigir a la página de inicio o dashboard
            if (auth()->user()->role === 'seller') {
                // Si la autenticación es exitosa y es un vendedor, redirigir a la página de inicio o dashboard
                return redirect()->route('ecommerce.categories');
            } else {
                // Si el usuario no es un vendedor, cerrar la sesión
                Auth::logout();
                return back()->withErrors([
                    'email' => 'No tienes permisos para acceder a esta área.',
                ]);
            }
        }

        // Si las credenciales no son válidas, regresar con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    // Método para procesar el logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('ecommerce.seller.login'); // Redirigir al login después de cerrar sesión
    }
}
