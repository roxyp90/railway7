<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibroRequest;
use App\Models\Libro;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibroController extends Controller
{
    /**
     * Protege el modulo de libros con autenticacion.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista los libros con su usuario registrador.
     */
    public function index(): View
    {
        $libros = Libro::query()
            ->with('registrador')
            ->latest()
            ->get();

        return view('libros.index', compact('libros'));
    }

    /**
     * Muestra el formulario de creacion de libros.
     */
    public function create(): View
    {
        $registradores = Usuario::query()->where('estado', 'activo')->orderBy('nombre')->get();

        return view('libros.create', compact('registradores'));
    }

    /**
     * Guarda un libro nuevo.
     */
    public function store(LibroRequest $request): RedirectResponse
    {
        // validated() trae solo datos confiables, ya filtrados por LibroRequest.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        Libro::create($data);

        return redirect()->route('libros.index')->with('success', 'Libro creado correctamente.');
    }

    /**
     * Presenta la vista de detalle de un libro.
     */
    public function show($id): View
    {
        // with() carga registrador y ejemplares en una consulta planificada para la vista show.
        // findOrFail() evita errores silenciosos cuando llega un ID inexistente.
        $libro = Libro::query()
            ->with(['registrador', 'ejemplares.prestamos.usuario'])
            ->findOrFail($id);

        return view('libros.show', compact('libro'));
    }

    /**
     * Muestra el formulario de edicion.
     */
    public function edit(Libro $libro): View
    {
        $registradores = Usuario::query()->where('estado', 'activo')->orderBy('nombre')->get();

        return view('libros.edit', compact('libro', 'registradores'));
    }

    /**
     * Actualiza el libro seleccionado.
     */
    public function update(LibroRequest $request, Libro $libro): RedirectResponse
    {
        // En PUT el Form Request aplica el unique ignorando el ID del libro actual.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        $libro->update($data);

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Elimina el libro.
     */
    public function destroy(Libro $libro): RedirectResponse
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente.');
    }

    /**
     * Cambia el estado administrativo activo / inactivo desde AJAX.
     */
    public function updateEstado(Request $request, Libro $libro)
    {
        $request->validate([
            'activo' => 'required|boolean',
        ]);

        $libro->update([
            'activo' => $request->boolean('activo'),
        ]);

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'activo' => $libro->activo,
        ]);
    }
}
