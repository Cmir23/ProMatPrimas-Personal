@extends('layouts.app')

@section('content')
<h1>Nuevo Usuario</h1>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
    </div>
    <div class="mb-3">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Roles</label>
        <select name="roles[]" class="form-select" multiple>
            @foreach($roles as $r)
                <option value="{{ $r->rol_id }}">{{ $r->nombre }}</option>
            @endforeach
        </select>
        <small>Usa CTRL o SHIFT para seleccionar varios</small>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
