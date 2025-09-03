<?php

namespace App\Http\Controllers;

use App\Models\UsuarioRol;
use Illuminate\Http\Request;

class UsuarioRolController extends Controller
{
    /**
     * Mostrar listado de usuario_rol
     */
    public function index()
    {
        $usuarioRoles = UsuarioRol::all();
        return view('usuarioroles.index', compact('usuarioRoles'));
    }

    /**
     * Formulario para crear una nueva relación
     */
    public function create()
    {
        return view('usuarioroles.create');
    }

    /**
     * Guardar una nueva relación
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'rol_id' => 'required|integer|exists:roles,id'
        ]);

        UsuarioRol::create($validated);

        return redirect()->route('usuarioroles.index')
                         ->with('success', 'Relación usuario-rol creada correctamente');
    }

    /**
     * Mostrar un registro específico
     */
    public function show($id)
    {
        $usuarioRol = UsuarioRol::findOrFail($id);
        return view('usuarioroles.show', compact('usuarioRol'));
    }

    /**
     * Formulario para editar un registro específico
     */
    public function edit($id)
    {
        $usuarioRol = UsuarioRol::findOrFail($id);
        return view('usuarioroles.edit', compact('usuarioRol'));
    }

    /**
     * Actualizar un registro específico
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'rol_id' => 'required|integer|exists:roles,id'
        ]);

        $usuarioRol = UsuarioRol::findOrFail($id);
        $usuarioRol->update($validated);

        return redirect()->route('usuarioroles.index')
                         ->with('success', 'Relación usuario-rol actualizada correctamente');
    }

    /**
     * Eliminar un registro específico
     */
    public function destroy($id)
    {
        $usuarioRol = UsuarioRol::findOrFail($id);
        $usuarioRol->delete();

        return redirect()->route('usuarioroles.index')
                         ->with('success', 'Relación usuario-rol eliminada correctamente');
    }
}