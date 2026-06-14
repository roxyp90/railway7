<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Este controlador prepara los datos resumidos que se ven en el panel principal.
    public function __construct()
    {
        // Solo un usuario autenticado puede entrar al dashboard.
        $this->middleware('auth');
    }

    public function index()
    {
        // Consultamos contadores rápidos para las tarjetas superiores del home.
        $totalLibros = DB::table('libros')->count();
        $totalUsuarios = DB::table('usuarios')->count();
        $prestamosActivos = DB::table('prestamos')
            ->whereRaw('LOWER(estado) = ?', ['prestado'])
            ->count();

        // Traemos los últimos 5 libros registrados para mostrarlos en la tabla rápida.
        $ultimosLibros = DB::table('libros')->orderBy('id', 'desc')->limit(5)->get();

        // Traemos los últimos 5 préstamos con el nombre del lector para dar contexto.
        $ultimosPrestamos = DB::table('prestamos')
            ->join('usuarios', 'prestamos.usuario_id', '=', 'usuarios.id')
            ->select('prestamos.*', 'usuarios.nombre as nombre_usuario')
            ->orderBy('prestamos.id', 'desc')
            ->limit(5)
            ->get();

        // Se envía toda la información consolidada a la vista home.
        return view('home', compact('totalLibros', 'totalUsuarios', 'prestamosActivos', 'ultimosLibros', 'ultimosPrestamos'));
    }
}
