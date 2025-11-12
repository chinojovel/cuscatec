<?php

namespace App\Http\Controllers\Eco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcoSessionController extends Controller
{

    public function saveState(Request $request)
    {
        $request->validate([
            'state' => 'required|exists:states,id',
        ]);

        // Guardar el estado seleccionado en la sesión
        session(['selected_state' => $request->state]);

        // Redirigir a la lista de productos
        return redirect()->route('ecommerce.categories');
    }
}
