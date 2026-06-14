<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestamoRequest;
use App\Models\Ejemplar;
use App\Models\Prestamo;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrestamoController extends Controller
{
    /**
     * Exige autenticacion para todo el modulo de prestamos.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista prestamos con lector, ejemplar, libro y auditoria.
     */
    public function index(): View
    {
        $prestamos = Prestamo::query()
            ->with(['usuario', 'ejemplar.libro', 'registrador'])
            ->latest()
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    /**
     * Abre el formulario de creacion.
     */
    public function create(): View
    {
        return view('prestamos.create', $this->getFormData());
    }

    /**
     * Guarda un nuevo prestamo.
     */
    public function store(PrestamoRequest $request): RedirectResponse
    {
        // validated() evita usar campos que no esten autorizados en PrestamoRequest.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        Prestamo::create($data);

        return redirect()->route('prestamos.index')->with('success', 'Prestamo creado correctamente.');
    }

    /**
     * Muestra el detalle del prestamo.
     */
    public function show($id): View
    {
        // with() precarga relaciones anidadas para mostrar auditoria y datos tecnicos sin N+1.
        // findOrFail() corta la ejecucion con 404 si el prestamo no existe.
        $prestamo = Prestamo::query()
            ->with(['usuario', 'ejemplar.libro', 'registrador'])
            ->findOrFail($id);

        return view('prestamos.show', compact('prestamo'));
    }

    /**
     * Abre el formulario de edicion.
     */
    public function edit(Prestamo $prestamo): View
    {
        return view('prestamos.edit', array_merge($this->getFormData(), compact('prestamo')));
    }

    /**
     * Actualiza un prestamo existente.
     */
    public function update(PrestamoRequest $request, Prestamo $prestamo): RedirectResponse
    {
        // validated() aplica las reglas PUT declaradas en el Form Request.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        $prestamo->update($data);

        return redirect()->route('prestamos.index')->with('success', 'Prestamo actualizado correctamente.');
    }

    /**
     * Elimina el prestamo.
     */
    public function destroy(Prestamo $prestamo): RedirectResponse
    {
        $prestamo->delete();

        return redirect()->route('prestamos.index')->with('success', 'Prestamo eliminado correctamente.');
    }

    /**
     * Cambia el estado administrativo activo / inactivo.
     */
    public function updateEstado(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'activo' => 'required|boolean',
        ]);

        $prestamo->update([
            'activo' => $request->boolean('activo'),
        ]);

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'activo' => $prestamo->activo,
        ]);
    }

    /**
     * Cambia el estado de negocio prestado / devuelto.
     */
    public function updateEstadoNegocio(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'estado' => 'required|string|in:prestado,devuelto',
        ]);

        $prestamo->update([
            'estado' => $request->estado,
        ]);

        return response()->json([
            'message' => 'Estado del negocio actualizado.',
            'estado' => $prestamo->estado,
        ]);
    }

    /**
     * Datos reutilizados por create y edit.
     */
    private function getFormData(): array
    {
        return [
            'lectores' => Usuario::query()->where('activo', true)->orderBy('nombre')->get(),
            'ejemplares' => Ejemplar::query()->with('libro')->orderBy('codigo_inventario')->get(),
            'registradores' => User::query()->where('activo', true)->orderBy('name')->get(),
        ];
    }
}
