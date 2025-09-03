@extends('layouts.app')

@section('title', 'Editar Rol')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Editar Rol: {{ isset($rol) ? $rol->nombre : 'Rol' }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $rol->rol_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Rol <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre', $rol->nombre) }}" 
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  rows="3" 
                                  placeholder="Describe las funciones de este rol...">{{ old('descripcion', $rol->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                            ← Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            📝 Actualizar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection