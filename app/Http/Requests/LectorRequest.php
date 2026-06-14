<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectorRequest extends FormRequest
{
    /**
     * Autoriza el uso de este Form Request.
     *
     * La autenticacion ya se controla desde el middleware del controlador, por eso
     * aqui devolvemos true para que Laravel permita ejecutar las reglas.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas del modulo Lectores / Clientes.
     *
     * Separamos POST y PUT porque crear y editar no tienen exactamente el mismo
     * comportamiento: al crear el correo debe ser unico en toda la tabla, mientras
     * que al editar debe ignorar el ID actual para no bloquearse contra si mismo.
     */
    public function rules(): array
    {
        $rules = [];

        if (request()->isMethod('post')) {
            $rules = [
                'nombre' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
                'correo' => 'required|string|email|max:255|unique:usuarios,correo',
                'telefono' => 'nullable|string|max:30|regex:/^[0-9+\-\s()]+$/',
                'direccion' => 'nullable|string|max:255',
                'tipo' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
                'registrado_por' => 'required|integer|exists:users,id',
            ];
        } elseif (request()->isMethod('put')) {
            $lector = $this->route('lector');
            $id = is_object($lector) ? $lector->id : $lector;

            $rules = [
                'nombre' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
                'correo' => 'required|string|email|max:255|unique:usuarios,correo,' . $id,
                'telefono' => 'nullable|string|max:30|regex:/^[0-9+\-\s()]+$/',
                'direccion' => 'nullable|string|max:255',
                'tipo' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
                'registrado_por' => 'required|integer|exists:users,id',
            ];
        }

        return $rules;
    }

    /**
     * Nombres legibles para que los mensajes de error sean claros en la interfaz.
     */
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'correo' => 'correo electronico',
            'telefono' => 'telefono',
            'direccion' => 'direccion',
            'tipo' => 'tipo de lector',
            'registrado_por' => 'usuario registrador',
        ];
    }
}
