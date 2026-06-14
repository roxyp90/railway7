<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    use HasFactory;

    // Modelo principal del flujo de préstamos del sistema.
    protected $table = 'prestamos';
    protected $primaryKey = 'id';

    // Datos que llegan desde formularios y se pueden guardar con create / update.
    protected $fillable = [
        'usuario_id',
        'ejemplar_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'fecha_entrega_real',
        'estado',
        'registrado_por',
        'activo',
    ];

    // El estado administrativo se trata como boolean.
    protected $casts = [
        'activo' => 'boolean',
    ];

    // Lector asociado al préstamo (Se mantiene apuntando a la tabla usuarios).
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Ejemplar físico entregado en el préstamo.
    public function ejemplar(): BelongsTo
    {
        return $this->belongsTo(Ejemplar::class, 'ejemplar_id');
    }

    // CORREGIDO: Ahora apunta a User (Administradores reales de la tabla 'users')
    public function registrador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}