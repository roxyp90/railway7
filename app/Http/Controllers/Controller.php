<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/*
|--------------------------------------------------------------------------
| CONTROLLER PRINCIPAL
|--------------------------------------------------------------------------
|
| Este es el controlador base de Laravel.
| Todos los demás controladores del proyecto
| pueden heredar de esta clase.
|
| Aquí se cargan funciones para:
| - Validar datos
| - Manejar permisos
| - Trabajar con controladores
|
*/

class Controller extends BaseController
{
    // Traits que agregan funcionalidades al controlador
    use AuthorizesRequests, ValidatesRequests;
}