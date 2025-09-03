<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create'); // No envía $rol porque es crear
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:rol,nombre',
            'descripcion' => 'nullable|string|max:500'
        ]);

        Rol::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rol = Rol::with('usuarios')->findOrFail($id);
        return view('roles.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rol = Rol::findOrFail($id); // Asegúrate de que esto esté correcto
        return view('roles.edit', compact('rol')); // Envía $rol a la vista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rol = Rol::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255|unique:rol,nombre,' . $rol->rol_id . ',rol_id',
            'descripcion' => 'nullable|string|max:500'
        ]);

        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Rol::findOrFail($id);
        
        // Verificar si el rol tiene usuarios asignados
        if ($rol->usuarios()->count() > 0) {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol porque tiene usuarios asignados');
        }

        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
    }
}