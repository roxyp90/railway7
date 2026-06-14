<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ejemplar extends Model
{
    use HasFactory;

    // Cada ejemplar representa una copia física de un libro.
    protected $table = 'ejemplares';
    protected $primaryKey = 'id';

    // Campos permitidos para asignación masiva.
    protected $fillable = [
        'libro_id',
        'codigo_inventario',
        'estado',
        'registrado_por'
    ];

    // Muchos ejemplares pertenecen a un solo libro.
    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    // Un ejemplar puede participar en varios préstamos a lo largo del tiempo.
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'ejemplar_id');
    }

    // Usuario que registró este ejemplar dentro del sistema.
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'registrado_por');
    }
}
