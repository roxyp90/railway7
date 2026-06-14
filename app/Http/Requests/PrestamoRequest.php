<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
{
    /**
     * El acceso general se protege en el controlador con auth.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas del modulo Prestamos.
     *
     * Aunque crear y editar comparten casi todas las reglas, se mantiene la
     * estructura POST/PUT para estandarizar el sistema y facilitar ajustes futuros
     * sin mezclar responsabilidades.
     */
    public function rules(): array
    {
        $rules = [];

        if (request()->isMethod('post')) {
            $rules = $this->baseRules();
        } elseif (request()->isMethod('put')) {
            $rules = $this->baseRules();
        }

        return $rules;
    }

    /**
     * Reglas comunes para creacion y edicion del prestamo.
     */
    private function baseRules(): array
    {
        return [
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'ejemplar_id' => 'required|integer|exists:ejemplares,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'fecha_entrega_real' => 'nullable|date|after_or_equal:fecha_prestamo',
            'estado' => 'required|string|in:prestado,devuelto',
            'registrado_por' => 'required|integer|exists:users,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'usuario_id' => 'lector',
            'ejemplar_id' => 'ejemplar',
            'fecha_prestamo' => 'fecha de prestamo',
            'fecha_devolucion' => 'fecha de devolucion',
            'fecha_entrega_real' => 'fecha de entrega real',
            'estado' => 'estado del prestamo',
            'registrado_por' => 'usuario registrador',
        ];
    }
}
