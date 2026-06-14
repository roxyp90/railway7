<?php

namespace App\Http\Controllers;

use App\Http\Requests\SancionRequest;
use App\Models\Prestamo;
use App\Models\Sancion;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SancionController extends Controller
{
    /**
     * Protege el modulo completo con autenticacion.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista sanciones con lector, prestamo y auditoria.
     */
    public function index(): View
    {
        $sanciones = Sancion::query()
            ->with(['usuario', 'prestamo.ejemplar.libro', 'registrador'])
            ->latest()
            ->get();

        return view('sanciones.index', compact('sanciones'));
    }

    /**
     * Abre el formulario de creacion.
     */
    public function create(): View
    {
        return view('sanciones.create', $this->getFormData());
    }

    /**
     * Guarda una sancion nueva.
     */
    public function store(SancionRequest $request): RedirectResponse
    {
        // validated() toma solo los campos aprobados por SancionRequest.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        Sancion::create($data);

        return redirect()->route('sanciones.index')->with('success', 'Sancion creada correctamente.');
    }

    /**
     * Muestra la vista de detalle de una sancion.
     */
    public function show($id): View
    {
        // with() trae lector, prestamo, libro y registrador antes de renderizar la vista.
        // findOrFail() responde con 404 si el ID no corresponde a una sancion real.
        $sancion = Sancion::query()
            ->with(['usuario', 'prestamo.usuario', 'prestamo.ejemplar.libro', 'registrador'])
            ->findOrFail($id);

        return view('sanciones.show', compact('sancion'));
    }

    /**
     * Abre el formulario de edicion.
     */
    public function edit(Sancion $sancion): View
    {
        return view('sanciones.edit', array_merge($this->getFormData(), compact('sancion')));
    }

    /**
     * Actualiza una sancion existente.
     */
    public function update(SancionRequest $request, Sancion $sancion): RedirectResponse
    {
        // validated() aplica las reglas PUT y deja el controlador sin bloques manuales de validacion.
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        $sancion->update($data);

        return redirect()->route('sanciones.index')->with('success', 'Sancion actualizada correctamente.');
    }

    /**
     * Elimina la sancion.
     */
    public function destroy(Sancion $sancion): RedirectResponse
    {
        $sancion->delete();

        return redirect()->route('sanciones.index')->with('success', 'Sancion eliminada correctamente.');
    }

    /**
     * Cambia el estado administrativo activo / inactivo.
     */
    public function updateEstado(Request $request, Sancion $sancion)
    {
        $request->validate([
            'activo' => 'required|boolean',
        ]);

        $sancion->update([
            'activo' => $request->boolean('activo'),
        ]);

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'activo' => $sancion->activo,
        ]);
    }

    /**
     * Cambia el estado de negocio pendiente / pagada.
     */
    public function updateEstadoNegocio(Request $request, Sancion $sancion)
    {
        $request->validate([
            'estado' => 'required|string|in:pendiente,pagada',
        ]);

        $sancion->update([
            'estado' => $request->estado,
        ]);

        return response()->json([
            'message' => 'Estado de la sancion actualizado.',
            'estado' => $sancion->estado,
        ]);
    }

    /**
     * Datos reutilizados por create y edit.
     */
    private function getFormData(): array
    {
        return [
            'lectores' => Usuario::query()->where('activo', true)->orderBy('nombre')->get(),
            'prestamos' => Prestamo::query()->with(['usuario', 'ejemplar.libro'])->latest()->get(),
            'registradores' => User::query()->where('activo', true)->orderBy('name')->get(),
        ];
    }
}
