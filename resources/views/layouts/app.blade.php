<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">ProMatPrimas</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('usuarios.index') }}" class="nav-link">Usuarios</a></li>
                    <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link">Roles</a></li>
                    <li class="nav-item"><a href="{{ route('usuarioroles.index') }}" class="nav-link">UsuarioRol</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>