<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    protected $table = 'usuario_rol';
    protected $primaryKey = 'usuario_rol_id';
    public $timestamps = false;

    protected $fillable = ['usuario_id','rol_id'];
}