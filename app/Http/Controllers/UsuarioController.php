<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('roles')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password_hash' => bcrypt($request->password),
            'imagen_url' => $request->imagen_url,
            'activo' => $request->activo ?? true,
        ]);

        $usuario->roles()->attach($request->roles);

        return redirect()->route('usuarios.index');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario','roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        $usuario->roles()->sync($request->roles);

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuarios.index');
    }
}