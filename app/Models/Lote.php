<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $table = 'lotes';
    
    protected $fillable = [
    'codigo_lote',
    'tipo_cultivo',
    'variedad',
    'fecha_cosecha',
    'cantidad_kg',
    'ubicacion_origen',
    'estado',
    'observaciones',
    'responsable',
    'precio_kg',
    'imagen_url'  
];

    protected $casts = [
        'fecha_cosecha' => 'date',
        'cantidad_kg' => 'decimal:2',
        'precio_kg' => 'decimal:2'
    ];
}