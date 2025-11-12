<?php

namespace App\Http\Controllers\CustomerEco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerEcoHomeController extends Controller
{
    // Método para mostrar la vista de login
    public function showLoginForm()
    {
        return view('customers_ecommerce.auth.eco-login'); // Asegúrate de tener una vista llamada `eco/login.blade.php`
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
            $user = auth()->user(); // Ahora sí tienes el usuario autenticado

            if ($user->role === 'customer') {
                
                // Asegúrate de cargar la relación customer
                $user->load('customer');

                // Guardar el estado seleccionado en la sesión
                session(['selected_state' => $user->customer->state_id]);

                return redirect()->route('customer.ecommerce.categories');
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
        return redirect()->route('customer.ecommerce.seller.login'); // Redirigir al login después de cerrar sesión
    }
}
