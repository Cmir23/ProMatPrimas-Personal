@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión Usuario-Rol</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('usuarioroles.create') }}" class="btn btn-primary mb-3">Nueva Relación</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarioRoles as $item)
                <tr>
                    <td>{{ $item->usuario_rol_id }}</td>
                    <td>{{ $item->usuario_id }}</td>
                    <td>{{ $item->rol_id }}</td>
                    <td>
                        <a href="{{ route('usuarioroles.show', $item->usuario_rol_id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('usuarioroles.edit', $item->usuario_rol_id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('usuarioroles.destroy', $item->usuario_rol_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar relación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection