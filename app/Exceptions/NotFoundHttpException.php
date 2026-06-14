<?php

namespace App\Exceptions;

use Exception;

/*
|--------------------------------------------------------------------------
| NOT FOUND HTTP EXCEPTION
|--------------------------------------------------------------------------
|
| Esta clase sirve para mostrar el error 404.
| El error 404 aparece cuando una página o ruta
| no existe dentro del sistema.
|
*/

class NotFoundHttpException extends Exception
{
    /**
     * Reportar la excepción
     */
    public function report()
    {
        // Aquí se podrían guardar logs del error
    }

    /**
     * Renderiza el error 404
     */
    public function render($request)
    {
        // Muestra la vista personalizada del error 404
        return response()->view('errors.404', [], 404);
    }
}