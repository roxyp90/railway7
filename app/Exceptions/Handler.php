<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

// Importaciones para detectar errores
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

/*
|--------------------------------------------------------------------------
| HANDLER
|--------------------------------------------------------------------------
|
| Este archivo sirve para manejar los errores de Laravel.
| Aquí podemos personalizar qué mostrar cuando ocurra un error
| como 404, 403, 419 o 500.
|
*/

class Handler extends ExceptionHandler
{
    /**
     * Errores que no se reportan
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Datos sensibles que no se guardan
     * cuando hay errores de validación
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Registro de excepciones
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Aquí se renderizan los errores
     */
    public function render($request, Throwable $exception)
    {
        // Error 404 -> Página no encontrada
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Error 403 -> Sin permisos
        if ($exception instanceof AccessDeniedHttpException) {
            return response()->view('errors.403', [], 403);
        }

        // Error 419 -> Sesión expirada
        if ($exception instanceof HttpException && $exception->getStatusCode() == 419) {
            return response()->view('errors.419', [], 419);
        }

        // Error 500 -> Error interno del servidor
        if ($this->isServerError($exception)) {
            return response()->view('errors.500', [], 500);
        }

        // Si no coincide con ninguno, Laravel lo maneja normal
        return parent::render($request, $exception);
    }

    /**
     * Función para detectar errores 500
     */
    private function isServerError(Throwable $e)
    {
        return $e instanceof \Symfony\Component\ErrorHandler\Error\FatalError || 
               $e instanceof \Error || 
               ($e instanceof HttpException && $e->getStatusCode() == 500);
    }
}