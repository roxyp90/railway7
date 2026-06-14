<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LectorController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\SancionController;

// Ruta pública inicial del sistema.
Route::get('/', function () {
    return view('welcome');
});

// Rutas automáticas de autenticación: login, register, recuperación de contraseña, etc.
Auth::routes();

// Todo lo administrativo queda protegido con auth para que solo entre un usuario logueado.
Route::middleware('auth')->group(function () {
    // Panel principal del sistema.
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRUD completo de usuarios y ruta extra para activar / desactivar desde la tabla.
    Route::resource('usuarios', UsuarioController::class)->parameters(['usuarios' => 'usuario'])->except(['show']);
    Route::patch('usuarios/{usuario}/estado', [UsuarioController::class, 'updateEstado'])->name('usuarios.estado');

    // CRUD completo de libros y ruta AJAX para cambiar el estado activo sin salir del listado.
    Route::resource('libros', LibroController::class)->parameters(['libros' => 'libro']);
    Route::patch('libros/{libro}/estado', [LibroController::class, 'updateEstado'])->name('libros.estado');

    // CRUD de lectores / clientes con su ruta de cambio rápido de estado.
    Route::resource('lectores', LectorController::class)->parameters(['lectores' => 'lector']);
    Route::patch('lectores/{lector}/estado', [LectorController::class, 'updateEstado'])->name('lectores.estado');

    // Rutas de préstamos: CRUD, estado administrativo y estado de negocio por separado.
    Route::resource('prestamos', PrestamoController::class)->parameters(['prestamos' => 'prestamo']);
    Route::patch('prestamos/{prestamo}/estado', [PrestamoController::class, 'updateEstado'])->name('prestamos.estado');
    Route::patch('prestamos/{prestamo}/estado-negocio', [PrestamoController::class, 'updateEstadoNegocio'])->name('prestamos.estadoNegocio');

    // Rutas de sanciones: CRUD, estado administrativo y estado de negocio por separado.
    Route::resource('sanciones', SancionController::class)->parameters(['sanciones' => 'sancion']);
    Route::patch('sanciones/{sancion}/estado', [SancionController::class, 'updateEstado'])->name('sanciones.estado');
    Route::patch('sanciones/{sancion}/estado-negocio', [SancionController::class, 'updateEstadoNegocio'])->name('sanciones.estadoNegocio');
});

// Rutas manuales para probar vistas de error.
Route::get('/error/404.blade', function () { return view('errors.404'); });
Route::get('/error/403.blade', function () { return view('errors.403'); });
Route::get('/error/419.blade', function () { return view('errors.419'); });
Route::get('/error/500.blade', function () { return view('errors.500'); });
