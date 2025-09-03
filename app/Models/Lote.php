<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    // Especificar tabla y clave primaria
    protected $table = 'lote';
    protected $primaryKey = 'LoteId';

    protected $fillable = [
        'UsuarioId',
        'Nombre',
        'Ubicacion',
        'Superficie',
        'Cultivo',
        'FechaSiembra',
        'EstadoActual',
        'ImagenUrl'
    ];

    protected $casts = [
        'FechaSiembra' => 'date',
        'Superficie' => 'decimal:2'
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioId', 'UsuarioId');
    }

    // Scopes para filtrar
    public function scopeByEstado($query, $estado)
    {
        return $query->where('EstadoActual', $estado);
    }

    public function scopeByCultivo($query, $cultivo)
    {
        return $query->where('Cultivo', 'like', '%' . $cultivo . '%');
    }
}