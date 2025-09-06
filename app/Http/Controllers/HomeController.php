<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Lote;

class HomeController extends Controller
{
    public function index()
    {
        // Estadísticas de usuarios
        $totalUsuarios = Usuario::count();
        
        // Estadísticas de lotes
        $totalLotes = Lote::count();
        $lotesEntregados = Lote::where('estado', 'entregado')->count();
        $lotesProcesando = Lote::where('estado', 'procesando')->count();
        $totalKg = Lote::sum('cantidad_kg');
        
        // Retornar vista dashboard (ya no home)
        return view('dashboard', compact(
            'totalUsuarios',
            'totalLotes', 
            'lotesEntregados', 
            'lotesProcesando', 
            'totalKg'
        ));
    }
}