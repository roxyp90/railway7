<?php

namespace App\Exceptions;

use Exception;

/*
|--------------------------------------------------------------------------
| INTERNAL SERVER ERROR HTTP EXCEPTION
|--------------------------------------------------------------------------
|
| Esta clase sirve para mostrar el error 500.
| Este error aparece cuando ocurre un problema interno
| en el servidor o en el sistema.
|
*/

class InternalServerErrorHttpException extends Exception
{
    /**
     * Renderiza el error 500
     */
    public function render($request)
    {
        // Muestra la vista personalizada del error 500
        return response()->view('errors.500', [], 500);
    }
}