@extends('layouts.app')

@section('title', 'Gestión de Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Nuevo Rol
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        @if($roles->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Usuarios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $rol)
                            <tr>
                                <td>{{ $rol->rol_id }}</td>
                                <td>
                                    <strong>{{ $rol->nombre }}</strong>
                                </td>
                                <td>{{ $rol->descripcion ?? 'Sin descripción' }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $rol->usuarios()->count() }} usuarios
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('roles.show', $rol->rol_id) }}" 
                                           class="btn btn-sm btn-outline-info" title="Ver">
                                            👁️
                                        </a>
                                        <a href="{{ route('roles.edit', $rol->rol_id) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Editar">
                                            ✏️
                                        </a>
                                        <form action="{{ route('roles.destroy', $rol->rol_id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este rol?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Eliminar">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <p class="text-muted">No hay roles registrados</p>
                <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear primer rol</a>
            </div>
        @endif
    </div>
</div>
@endsection