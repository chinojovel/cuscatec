<?php

use App\Models\State;

if (!function_exists('getState')) {
    function getState() {
        // Aquí va la lógica de tu función
        $stateId = session('selected_state'); // Aquí obtienes el estado guardado en sesión
        if (!$stateId) {
            return "";
        }

        // Buscar el estado por su ID (o podría ser otra forma de identificación)
        $state = State::find($stateId);
        if (isset($state)) {
           return $state->name;
        }

        return "";
    }
}