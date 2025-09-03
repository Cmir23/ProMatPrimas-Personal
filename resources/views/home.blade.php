@extends('layouts.app')

@section('title', $titulo)

@section('content')
<style>
    .header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px 20px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .navigation {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        flex-wrap: wrap;
    }
    
    /* Cambié .nav-link por .custom-nav-link para evitar conflictos */
    .custom-nav-link {
        background: #007bff;
        color: white;
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }
    
    .custom-nav-link:hover {
        background: #0056b3;
        color: white;
    }
</style>

<div class="header">
    <h1>{{ $titulo }}</h1>
    <p>{{ $mensaje }}</p>
</div>

<div class="stats">
    <div class="stat-card">
        <h3>👥 Usuarios</h3>
        <p style="font-size: 2em; margin: 10px 0;">{{ $total_usuarios }}</p>
        <small>Total registrados</small>
    </div>
    
    <div class="stat-card">
        <h3>📅 Fecha</h3>
        <p style="font-size: 1.5em; margin: 10px 0;">{{ $fecha }}</p>
        <small>Fecha actual</small>
    </div>
    
    <div class="stat-card">
        <h3>⚡ Estado</h3>
        <p style="font-size: 1.5em; margin: 10px 0; color: green;">Activo</p>
        <small>Sistema funcionando</small>
    </div>
</div>

<div class="navigation">
    <a href="{{ route('usuarios.index') }}" class="custom-nav-link">Ver Usuarios</a>
    <a href="{{ route('roles.index') }}" class="custom-nav-link">Ver Roles</a>
</div>
@endsection