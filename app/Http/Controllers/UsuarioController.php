<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    // Este controlador maneja el CRUD del personal / usuarios del sistema.
    public function __construct()
    {
        // Se protege el módulo para que no entren usuarios sin autenticación.
        $this->middleware('auth');
    }

    public function index(): View
    {
        // Listado general de usuarios ordenado por los más recientes.
        $usuarios = User::query()->latest()->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        return view('usuarios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Valido la información antes de crear el usuario.
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'activo' => 'nullable|boolean',
        ]);

        // La contraseña se cifra y el registro queda guardado en la tabla users.
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activo' => $request->boolean('activo', true),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario): View
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        // Aquí exceptúo el correo actual para que el propio usuario pueda editarse sin error de unique.
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
            'activo' => 'nullable|boolean',
        ]);

        $usuario->name = $data['name'];
        $usuario->email = $data['email'];
        $usuario->activo = $request->boolean('activo', true);

        // Solo cambio la contraseña si el formulario trae una nueva.
        if (! empty($data['password'])) {
            $usuario->password = Hash::make($data['password']);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario): RedirectResponse
    {
        // Excepción importante: el usuario autenticado no puede eliminar su propia cuenta.
        if (Auth::id() === $usuario->id) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // Si pasa la validación anterior, se elimina desde la tabla y también en la BD.
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function updateEstado(Request $request, User $usuario)
    {
        // Esta acción la usa el switch activo / inactivo del listado.
        $request->validate([
            'activo' => 'required|boolean',
        ]);

        // Segunda excepción importante: tampoco dejo desactivar al usuario actual.
        if (Auth::id() === $usuario->id && ! $request->boolean('activo')) {
            return response()->json([
                'message' => 'No puedes desactivar tu propio usuario.',
            ], 422);
        }

        $usuario->activo = $request->boolean('activo');
        $usuario->save();

        // La respuesta JSON permite reflejar el cambio de inmediato en la pantalla.
        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'activo' => $usuario->activo,
        ]);
    }
}
