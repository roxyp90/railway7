<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Añadido para tipado limpio

class Libro extends Model
{
    use HasFactory;

    // Modelo principal de los libros del inventario.
    protected $table = 'libros';
    protected $primaryKey = 'id';

    // Campos permitidos para create / update masivo desde formularios.
    protected $fillable = [
        'titulo',
        'autor',
        'editorial',
        'anio',
        'estado',
        'registrado_por',
        'activo',
        'imagen',
    ];

    // Conversiones automáticas de tipos.
    protected $casts = [
        'activo' => 'boolean',
    ];

    // Un libro puede tener varios ejemplares físicos relacionados.
    public function ejemplares(): HasMany
    {
        return $this->hasMany(Ejemplar::class, 'libro_id');
    }

    // CORREGIDO: Ahora apunta a User (Administradores reales de la tabla 'users')
    public function registrador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
