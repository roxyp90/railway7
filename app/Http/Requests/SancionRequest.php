<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SancionRequest extends FormRequest
{
    /**
     * Permite ejecutar la validacion. La autenticacion vive en el controlador.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas del modulo Sanciones.
     *
     * La separacion por metodo HTTP deja claro cuando el sistema esta creando y
     * cuando esta editando. En este modulo no hay unique, pero se conserva el
     * mismo patron profesional usado en los demas recursos.
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
     * Reglas comunes para crear y actualizar sanciones.
     */
    private function baseRules(): array
    {
        return [
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'prestamo_id' => 'required|integer|exists:prestamos,id',
            'motivo' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'multa' => 'required|numeric|min:0',
            'fecha_sancion' => 'required|date',
            'dias_retraso' => 'required|integer|min:0',
            'estado' => 'required|string|in:pendiente,pagada',
            'registrado_por' => 'required|integer|exists:users,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'usuario_id' => 'lector',
            'prestamo_id' => 'prestamo',
            'motivo' => 'motivo',
            'multa' => 'multa',
            'fecha_sancion' => 'fecha de sancion',
            'dias_retraso' => 'dias de retraso',
            'estado' => 'estado de la sancion',
            'registrado_por' => 'usuario registrador',
        ];
    }
}
