<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // AÑADIDO

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'tipo',
        'estado',
        'activo',
        'registrado_por', // AÑADIDO
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación añadida: Administrador de la tabla 'users' que registró a este lector
    public function registrador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }

    public function sanciones(): HasMany
    {
        return $this->hasMany(Sancion::class, 'usuario_id');
    }
}