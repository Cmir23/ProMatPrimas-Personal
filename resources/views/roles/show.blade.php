@extends('layouts.app')

@section('title', 'Detalles del Rol')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detalles del Rol</h4>
                <div>
                    <a href="{{ route('roles.edit', $rol->rol_id) }}" class="btn btn-warning btn-sm">
                        ✏️ Editar
                    </a>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                        ← Volver
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>ID:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $rol->rol_id }}
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-3">
                        <strong>Nombre:</strong>
                    </div>
                    <div class="col-md-9">
                        <span class="badge bg-primary fs-6">{{ $rol->nombre }}</span>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-3">
                        <strong>Descripción:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $rol->descripcion ?? 'Sin descripción' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Usuarios con este Rol</h5>
            </div>
            <div class="card-body">
                @if($rol->usuarios->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($rol->usuarios as $usuario)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $usuario->nombre }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $usuario->email }}</small>
                                </div>
                                <span class="badge bg-{{ $usuario->activo ? 'success' : 'secondary' }}">
                                    {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No hay usuarios asignados a este rol</p>
                @endif
                
                <div class="mt-3">
                    <small class="text-muted">
                        Total: {{ $rol->usuarios->count() }} usuario(s)
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection