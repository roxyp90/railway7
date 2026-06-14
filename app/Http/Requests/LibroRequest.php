<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibroRequest extends FormRequest
{
    /**
     * Permite que el controlador use este Request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas del modulo Libros.
     *
     * La validacion distingue POST y PUT para aplicar unique de forma correcta:
     * en POST el titulo no puede existir, y en PUT se ignora el libro actual para
     * que guardar cambios menores no falle por el mismo titulo del registro.
     */
    public function rules(): array
    {
        $rules = [];

        if (request()->isMethod('post')) {
            $rules = [
                'titulo' => 'required|string|max:255|unique:libros,titulo',
                'autor' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
                'editorial' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
                'anio' => 'required|integer|min:1000|max:' . date('Y'),
                'estado' => 'required|string|in:disponible,prestado',
                'registrado_por' => 'required|integer|exists:users,id',
            ];
        } elseif (request()->isMethod('put')) {
            $libro = $this->route('libro');
            $id = is_object($libro) ? $libro->id : $libro;

            $rules = [
                'titulo' => 'required|string|max:255|unique:libros,titulo,' . $id,
                'autor' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
                'editorial' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
                'anio' => 'required|integer|min:1000|max:' . date('Y'),
                'estado' => 'required|string|in:disponible,prestado',
                'registrado_por' => 'required|integer|exists:users,id',
            ];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'titulo' => 'titulo',
            'autor' => 'autor',
            'editorial' => 'editorial',
            'anio' => 'anio',
            'estado' => 'estado del libro',
            'registrado_por' => 'usuario registrador',
        ];
    }
}
