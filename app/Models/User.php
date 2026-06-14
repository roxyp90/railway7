<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
|--------------------------------------------------------------------------
| MODELO USER
|--------------------------------------------------------------------------
|
| Este modelo representa los usuarios del sistema.
| Laravel lo usa para el login, autenticación
| y manejo de sesiones.
|
*/

class User extends Authenticatable
{
    // Traits para factories y notificaciones
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    |
    | Campos que se pueden llenar masivamente.
    |
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'activo',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden
    |--------------------------------------------------------------------------
    |
    | Campos que se ocultan cuando se serializa el modelo.
    |
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    |
    | Convierte automáticamente los tipos de datos.
    |
    */

    protected function casts(): array
    {
        return [

            // Convierte la fecha de verificación
            'email_verified_at' => 'datetime',

            // Encripta automáticamente la contraseña
            'password' => 'hashed',

            // Convierte activo en true o false
            'activo' => 'boolean',
        ];
    }
}