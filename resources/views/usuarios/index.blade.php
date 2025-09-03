@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo Usuario</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Email</th><th>Roles</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $u)
        <tr>
            <td>{{ $u->usuario_id }}</td>
            <td>{{ $u->nombre }}</td>
            <td>{{ $u->email }}</td>
            <td>
                @foreach($u->roles as $r)
                    <span class="badge bg-success">{{ $r->nombre }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('usuarios.edit',$u->usuario_id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('usuarios.destroy',$u->usuario_id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
