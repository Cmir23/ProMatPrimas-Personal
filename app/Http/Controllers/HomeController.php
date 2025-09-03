<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Cambiado de User a Usuario

class HomeController extends Controller
{
    public function index()
    {
        // Usar tu modelo Usuario en lugar de User
        $totalUsuarios = Usuario::count();
        $fechaActual = now()->format('d/m/Y');
        
        // Datos que quieres pasar a la vista
        $data = [
            'titulo' => 'Bienvenido a Mi Aplicación',
            'total_usuarios' => $totalUsuarios,
            'fecha' => $fechaActual,
            'mensaje' => 'Esta es tu página de inicio personalizada'
        ];
        
        // Retornar la vista con los datos
        return view('home', $data);
    }
}