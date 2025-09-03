<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Relación Usuario-Rol</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    <style>
        .card-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        .form-floating > .form-control:focus,
        .form-floating > .form-control:not(:placeholder-shown) {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
        .form-floating > label {
            opacity: 0.65;
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            opacity: 1;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 58px !important;
            border-radius: 0.375rem;
        }
        .select2-container--bootstrap-5 .select2-selection__rendered {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
        .preview-card {
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .preview-card.active {
            border-color: #0d6efd;
            background-color: #e7f3ff;
        }
        .info-icon {
            cursor: help;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nueva Relación Usuario-Rol
                            </h5>
                            <a href="/usuario-rol" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="usuarioRolForm" novalidate>
                            <div class="row">
                                <!-- Selección de Usuario -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="usuario_id" name="usuario_id" required>
                                            <option value="">Seleccionar usuario...</option>
                                        </select>
                                        <label for="usuario_id">
                                            Usuario
                                            <i class="fas fa-info-circle info-icon ms-1" 
                                               data-bs-toggle="tooltip" 
                                               title="Selecciona el usuario al que asignarás el rol">
                                            </i>
                                        </label>
                                        <div class="invalid-feedback">
                                            Por favor selecciona un usuario.
                                        </div>
                                    </div>
                                </div>

                                <!-- Selección de Rol -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="rol_id" name="rol_id" required>
                                            <option value="">Seleccionar rol...</option>
                                        </select>
                                        <label for="rol_id">
                                            Rol
                                            <i class="fas fa-info-circle info-icon ms-1" 
                                               data-bs-toggle="tooltip" 
                                               title="Selecciona el rol que se asignará al usuario">
                                            </i>
                                        </label>
                                        <div class="invalid-feedback">
                                            Por favor selecciona un rol.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista Previa -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="preview-card p-4" id="previewCard">
                                        <h6 class="text-muted mb-3">
                                            <i class="fas fa-eye me-2"></i>
                                            Vista Previa de la Relación
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-user text-primary me-2"></i>
                                                    <strong>Usuario:</strong>
                                                    <span class="ms-2" id="previewUsuario">No seleccionado</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-shield-alt text-success me-2"></i>
                                                    <strong>Rol:</strong>
                                                    <span class="ms-2" id="previewRol">No seleccionado</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-info mb-0 mt-3" style="display: none;" id="relationshipInfo">
                                            <i class="fas fa-lightbulb me-2"></i>
                                            <strong>Información:</strong> <span id="relationshipMessage"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                            <i class="fas fa-undo me-1"></i>
                                            Limpiar Formulario
                                        </button>
                                        <button type="submit" class="btn btn-success" id="submitBtn">
                                            <span class="spinner-border spinner-border-sm d-none me-2" id="submitSpinner"></span>
                                            <i class="fas fa-save me-1" id="submitIcon"></i>
                                            Crear Relación
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card de Ayuda -->
                <div class="card mt-4 border-info">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-question-circle me-2"></i>
                            Ayuda
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary">¿Qué hace esta función?</h6>
                                <p class="small text-muted mb-3">
                                    Permite asignar roles específicos a usuarios del sistema, definiendo sus permisos y nivel de acceso.
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary">Consideraciones importantes:</h6>
                                <ul class="small text-muted">
                                    <li>Un usuario puede tener múltiples roles</li>
                                    <li>No se pueden crear relaciones duplicadas</li>
                                    <li>La relación se activa inmediatamente</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast para notificaciones -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        <div id="toast" class="toast hide" role="alert">
            <div class="toast-header">
                <strong class="me-auto">Notificación</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="toastBody"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        let usuarios = [];
        let roles = [];

        $(document).ready(function() {
            initializeComponents();
            loadData();
            setupEventListeners();
        });

        function initializeComponents() {
            // Inicializar Select2
            $('#usuario_id, #rol_id').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: function() {
                    return $(this).data('placeholder');
                }
            });

            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        async function loadData() {
            try {
                // Cargar usuarios (simulado - reemplazar con API real)
                usuarios = [
                    { id: 1, nombre: 'Juan Pérez', email: 'juan@example.com' },
                    { id: 2, nombre: 'María García', email: 'maria@example.com' },
                    { id: 3, nombre: 'Carlos López', email: 'carlos@example.com' },
                    { id: 4, nombre: 'Ana Martínez', email: 'ana@example.com' }
                ];

                // Cargar roles (simulado - reemplazar con API real)
                roles = [
                    { id: 1, nombre: 'Administrador', descripcion: 'Acceso completo al sistema' },
                    { id: 2, nombre: 'Editor', descripcion: 'Puede crear y editar contenido' },
                    { id: 3, nombre: 'Viewer', descripcion: 'Solo lectura' },
                    { id: 4, nombre: 'Moderador', descripcion: 'Gestión de contenido y usuarios' }
                ];

                populateSelects();
            } catch (error) {
                showToast('Error al cargar los datos', 'error');
            }
        }

        function populateSelects() {
            // Llenar select de usuarios
            const usuarioSelect = $('#usuario_id');
            usuarioSelect.empty().append('<option value="">Seleccionar usuario...</option>');
            usuarios.forEach(usuario => {
                usuarioSelect.append(`<option value="${usuario.id}">${usuario.nombre} (${usuario.email})</option>`);
            });

            // Llenar select de roles
            const rolSelect = $('#rol_id');
            rolSelect.empty().append('<option value="">Seleccionar rol...</option>');
            roles.forEach(rol => {
                rolSelect.append(`<option value="${rol.id}">${rol.nombre} - ${rol.descripcion}</option>`);
            });
        }

        function setupEventListeners() {
            // Actualizar vista previa cuando cambian las selecciones
            $('#usuario_id, #rol_id').on('change', updatePreview);

            // Manejar envío del formulario
            $('#usuarioRolForm').on('submit', handleSubmit);
        }

        function updatePreview() {
            const usuarioId = $('#usuario_id').val();
            const rolId = $('#rol_id').val();
            const previewCard = $('#previewCard');
            
            let usuarioText = 'No seleccionado';
            let rolText = 'No seleccionado';

            if (usuarioId) {
                const usuario = usuarios.find(u => u.id == usuarioId);
                usuarioText = usuario ? `${usuario.nombre} (ID: ${usuario.id})` : 'Usuario no encontrado';
            }

            if (rolId) {
                const rol = roles.find(r => r.id == rolId);
                rolText = rol ? `${rol.nombre} (ID: ${rol.id})` : 'Rol no encontrado';
            }

            $('#previewUsuario').text(usuarioText);
            $('#previewRol').text(rolText);

            // Activar/desactivar vista previa
            if (usuarioId && rolId) {
                previewCard.addClass('active');
                $('#relationshipInfo').show();
                $('#relationshipMessage').text('Se creará una nueva relación usuario-rol con los datos seleccionados.');
            } else {
                previewCard.removeClass('active');
                $('#relationshipInfo').hide();
            }
        }

        async function handleSubmit(e) {
            e.preventDefault();
            
            const form = e.target;
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const submitBtn = $('#submitBtn');
            const submitIcon = $('#submitIcon');
            const submitSpinner = $('#submitSpinner');

            try {
                // UI de carga
                submitBtn.prop('disabled', true);
                submitIcon.addClass('d-none');
                submitSpinner.removeClass('d-none');

                const formData = {
                    usuario_id: parseInt($('#usuario_id').val()),
                    rol_id: parseInt($('#rol_id').val())
                };

                const response = await fetch('/api/usuario-rol', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Relación usuario-rol creada correctamente', 'success');
                    
                    // Redirigir después de un breve delay
                    setTimeout(() => {
                        window.location.href = '/usuario-rol';
                    }, 1500);
                } else {
                    showToast(data.message || 'Error al crear la relación', 'error');
                }

            } catch (error) {
                showToast('Error de conexión', 'error');
            } finally {
                // Restaurar UI
                submitBtn.prop('disabled', false);
                submitIcon.removeClass('d-none');
                submitSpinner.addClass('d-none');
            }
        }

        function resetForm() {
            $('#usuarioRolForm')[0].reset();
            $('#usuarioRolForm').removeClass('was-validated');
            $('#usuario_id, #rol_id').val(null).trigger('change');
            updatePreview();
            showToast('Formulario limpiado', 'info');
        }

        function showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            const toastBody = document.getElementById('toastBody');
            
            toastBody.textContent = message;
            toast.className = `toast show bg-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} text-white`;
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }
    </script>
</body>
</html>