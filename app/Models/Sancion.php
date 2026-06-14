<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sancion extends Model
{
    use HasFactory;

    // Modelo encargado de multas o sanciones asociadas a préstamos.
    protected $table = 'sanciones';
    protected $primaryKey = 'id';

    // Campos permitidos para asignación masiva desde formularios.
    protected $fillable = [
        'usuario_id',
        'prestamo_id',
        'motivo',
        'multa',
        'fecha_sancion',
        'dias_retraso',
        'estado',
        'registrado_por',
        'activo',
    ];

    // El estado administrativo se maneja como boolean.
    protected $casts = [
        'activo' => 'boolean',
    ];

    // Lector sancionado.
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Préstamo que originó la sanción.
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class, 'prestamo_id');
    }

    // CORREGIDO: Ahora apunta a User (Administradores reales de la tabla 'users')
    public function registrador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}