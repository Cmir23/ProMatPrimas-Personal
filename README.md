# ProMatPrimas - Sistema de Trazabilidad Agrícola

Sistema de gestión y trazabilidad de materias primas agrícolas desarrollado con Laravel y AdminLTE, diseñado como microservicio para control de calidad desde la cosecha hasta la entrega.

## Características

- **CRUD de Lotes**: Gestión completa de lotes agrícolas con estados de trazabilidad
- **Sistema de Usuarios y Roles**: Control de acceso basado en roles (Administrador, Agricultor, Supervisor, Operador)
- **Dashboard AdminLTE**: Interfaz administrativa moderna con estadísticas en tiempo real
- **Base de datos PostgreSQL**: Almacenamiento robusto y escalable
- **API REST**: Preparado para integración con aplicaciones móviles
- **Formularios avanzados**: Validación completa y experiencia de usuario optimizada

## Tecnologías

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: AdminLTE 3.2.0 + Bootstrap
- **Base de datos**: PostgreSQL
- **Servidor web**: Apache/Nginx
- **Dependencias**: Composer, NPM

## Instalación

### Prerrequisitos

- PHP 8.2 o superior
- Composer
- PostgreSQL 12+
- Node.js y NPM
- Git

### Paso a paso

1. **Clonar el repositorio**
```bash
git clone https://github.com/Cmir23/ProMatPrimas-Personal.git
cd ProMatPrimas-Personal
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos en .env**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=promatprimas
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

5. **Crear base de datos en PostgreSQL**
```sql
CREATE DATABASE promatprimas;
```

6. **Ejecutar migraciones y seeders**
```bash
php artisan migrate
php artisan db:seed --class=RolSeeder
php artisan db:seed --class=UsuarioSeeder
```

7. **Configurar permisos (Linux/Mac)**
```bash
chmod -R 775 storage bootstrap/cache
```

8. **Iniciar servidor de desarrollo**
```bash
php artisan serve
```

Visita: `http://127.0.0.1:8000`

## Uso

### Dashboard Principal
- Accede a `/` para ver estadísticas generales
- Visualiza totales de lotes, estados y producción

### Gestión de Lotes
- **Listar**: `/lotes`
- **Crear**: `/lotes/create`
- **Editar**: `/lotes/{id}/edit`
- **Ver detalles**: `/lotes/{id}`

### Administración de Usuarios
- **Usuarios**: `/usuarios`
- **Roles**: `/roles`
- **Asignación de roles**: `/usuarioroles`

### Datos de prueba

El sistema incluye usuarios y roles predefinidos:

**Usuarios:**
- Admin Test (admin@test.com)
- Administrador Sistema (admin@promatprimas.com)
- Juan Agricultor (agricultor@promatprimas.com)

**Roles:**
- Administrador
- Agricultor
- Supervisor
- Operador

## Estructura del proyecto

```
├── app/
│   ├── Http/Controllers/     # Controladores principales
│   ├── Models/              # Modelos Eloquent
│   └── ...
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/            # Datos iniciales
├── resources/
│   └── views/              # Vistas Blade AdminLTE
├── routes/
│   └── web.php             # Rutas web
└── ...
```

## API Endpoints

El sistema expone APIs REST para integración:

```
GET    /api/lotes           # Listar lotes
POST   /api/lotes           # Crear lote
GET    /api/lotes/{id}      # Ver lote
PUT    /api/lotes/{id}      # Actualizar lote
DELETE /api/lotes/{id}      # Eliminar lote
```

## Contribuir

1. Fork el proyecto
2. Crea una rama feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Roadmap

- [ ] Integración Blockchain para trazabilidad inmutable
- [ ] Aplicación móvil React Native/Flutter
- [ ] Códigos QR para seguimiento
- [ ] Reportes PDF automatizados
- [ ] Notificaciones en tiempo real
- [ ] Dashboard con gráficos avanzados

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para detalles.

## Soporte

Para soporte técnico o consultas, contacta a: [tu-email@dominio.com]

---

**Desarrollado para proyecto de trazabilidad agrícola con arquitectura de microservicios**
