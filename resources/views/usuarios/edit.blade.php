@extends('layouts.app')

@section('content')
<h1>Editar Usuario</h1>

<form action="{{ route('usuarios.update',$usuario->usuario_id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ $usuario->telefono }}">
    </div>
    <div class="mb-3">
        <label>Roles</label>
        <select name="roles[]" class="form-select" multiple>
            @foreach($roles as $r)
                <option value="{{ $r->rol_id }}" 
                    {{ $usuario->roles->contains($r->rol_id) ? 'selected' : '' }}>
                    {{ $r->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
