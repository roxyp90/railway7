<?php

namespace App\Exceptions;

use Exception;

/*
|--------------------------------------------------------------------------
| SESSION EXPIRED HTTP EXCEPTION
|--------------------------------------------------------------------------
|
| Esta clase sirve para mostrar el error 419.
| Este error aparece cuando la sesión expira
| o el token CSRF ya no es válido.
|
*/

class SessionExpiredHttpException extends Exception
{
    /**
     * Renderiza el error 419
     */
    public function render($request)
    {
        // Muestra la vista personalizada del error 419
        return response()->view('errors.419', [], 419);
    }
}