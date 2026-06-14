<?php

namespace App\Exceptions;

use Exception;

/*
|--------------------------------------------------------------------------
| ACCESS DENIED HTTP EXCEPTION
|--------------------------------------------------------------------------
|
| Esta clase sirve para mostrar el error 403 cuando un usuario
| intenta entrar a una página sin permisos.
|
*/

class AccessDeniedHttpException extends Exception
{
    /**
     * Renderiza el error 403
     */
    public function render($request)
    {
        // Muestra la vista personalizada del error 403
        return response()->view('errors.403', [], 403);
    }
}