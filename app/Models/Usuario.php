<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'UsuarioId';
    public $timestamps = true;

    protected $fillable = [
        'nombre','email','telefono','password'  // Agregar password
    ];

    protected $hidden = [
        'password'  // Ocultar contraseña en respuestas JSON
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'usuario_id', 'rol_id', 'UsuarioId', 'rol_id');
    }
}