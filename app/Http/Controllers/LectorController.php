<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectorRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LectorController extends Controller
{
    /**
     * Protege todo el CRUD de lectores para usuarios autenticados.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el listado principal de lectores.
     */
    public function index(): View
    {
        $lectores = Usuario::query()
            ->with('registrador')
            ->latest()
            ->get();

        return view('lectores.index', compact('lectores'));
    }

    /**
     * Abre el formulario de creacion.
     */
    public function create(): View
    {
        $registradores = User::query()->where('activo', true)->orderBy('name')->get();

        return view('lectores.create', compact('registradores'));
    }

    /**
     * Guarda un lector nuevo usando LectorRequest.
     */
    public function store(LectorRequest $request): RedirectResponse
    {
        // validated() devuelve solo los campos que pasaron las reglas del Form Request.
        // Esto evita guardar datos inesperados y mantiene el controlador limpio.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);
        $data['estado'] = $data['activo'] ? 'activo' : 'inactivo';

        Usuario::create($data);

        return redirect()->route('lectores.index')->with('success', 'Lector creado correctamente.');
    }

    /**
     * Muestra el detalle tecnico y de auditoria de un lector.
     */
    public function show($id): View
    {
        // with() precarga relaciones para evitar consultas repetidas al pintar la vista.
        // findOrFail() devuelve 404 automaticamente si el ID no existe.
        $lector = Usuario::query()
            ->with(['registrador', 'prestamos.ejemplar.libro', 'sanciones'])
            ->findOrFail($id);

        return view('lectores.show', compact('lector'));
    }

    /**
     * Abre el formulario de edicion.
     */
    public function edit(Usuario $lector): View
    {
        $registradores = User::query()->where('activo', true)->orderBy('name')->get();

        return view('lectores.edit', compact('lector', 'registradores'));
    }

    /**
     * Actualiza un lector existente usando LectorRequest.
     */
    public function update(LectorRequest $request, Usuario $lector): RedirectResponse
    {
        // validated() aplica las reglas PUT del Request, incluyendo el unique con ignore.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);
        $data['estado'] = $data['activo'] ? 'activo' : 'inactivo';

        $lector->update($data);

        return redirect()->route('lectores.index')->with('success', 'Lector actualizado correctamente.');
    }

    /**
     * Elimina el lector seleccionado.
     */
    public function destroy(Usuario $lector): RedirectResponse
    {
        $lector->delete();

        return redirect()->route('lectores.index')->with('success', 'Lector eliminado correctamente.');
    }

    /**
     * Cambia el estado administrativo desde el switch del listado.
     */
    public function updateEstado(Request $request, Usuario $lector)
    {
        $request->validate([
            'activo' => 'required|boolean',
        ]);

        $activo = $request->boolean('activo');

        $lector->update([
            'activo' => $activo,
            'estado' => $activo ? 'activo' : 'inactivo',
        ]);

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'activo' => $lector->activo,
        ]);
    }
}
