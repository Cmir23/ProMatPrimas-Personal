<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relación Usuario-Rol</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    <style>
        .card-header {
            background: linear-gradient(135deg, #fd7e14 0%, #ffc107 100%);
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
            border: 2px solid #e9ecef;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .preview-card.modified {
            border-color: #fd7e14;
            background-color: #fff3e0;
        }
        .preview-card.active {
            border-color: #0d6efd;
            background-color: #e7f3ff;
        }
        .info-icon {
            cursor: help;
        }
        .current-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 0.5rem;
            border-left: 4px solid #2196f3;
        }
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <!-- Loading Card -->
                <div class="card shadow" id="loadingCard">
                    <div class="card-body text-center py-5">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <h5 class="text-muted">Cargando datos...</h5>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="card shadow d-none" id="mainCard">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-edit me-2"></i>
                                Editar Relación Usuario-Rol
                                <span class="badge bg-light text-dark ms-2" id="relationId"></span>
                            </h5>
                            <a href="/usuario-rol" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Información Actual -->
                        <div class="current-info p-4 mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Datos Actuales
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        <strong>Usuario:</strong>
                                        <span class="ms-2" id="currentUsuario">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-shield-alt text-success me-2"></i>
                                        <strong>Rol:</strong>
                                        <span class="ms-2" id="currentRol">-</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-muted small mt-2">
                                <i class="fas fa-clock me-1"></i>
                                Última modificación: <span id="lastModified">-</span>
                            </div>
                        </div>

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
                                               title="Selecciona el nuevo usuario para esta relación">
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
                                               title="Selecciona el nuevo rol para esta relación">
                                            </i>
                                        </label>
                                        <div class="invalid-feedback">
                                            Por favor selecciona un rol.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista Previa de Cambios -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="preview-card p-4" id="previewCard">
                                        <h6 class="text-muted mb-3">
                                            <i class="fas fa-eye me-2"></i>
                                            Vista Previa de Cambios
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-user me-2" id="previewUsuarioIcon"></i>
                                                    <strong>Usuario:</strong>
                                                    <span class="ms-2" id="previewUsuario">No seleccionado</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-shield-alt me-2" id="previewRolIcon"></i>
                                                    <strong>Rol:</strong>
                                                    <span class="ms-2" id="previewRol">No seleccionado</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert mb-0 mt-3" style="display: none;" id="changeAlert">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong id="changeTitle">Cambios detectados:</strong>
                                            <div id="changesList"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-between">
                                        <button type="button" class="btn btn-outline-danger" onclick="confirmReset()">
                                            <i class="fas fa-undo me-1"></i>
                                            Restablecer Valores
                                        </button>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-secondary" onclick="cancelEdit()">
                                                <i class="fas fa-times me-1"></i>
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-warning" id="submitBtn" disabled>
                                                <span class="spinner-border spinner-border-sm d-none me-2" id="submitSpinner"></span>
                                                <i class="fas fa-save me-1" id="submitIcon"></i>
                                                Actualizar Relación
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card de Ayuda -->
                <div class="card mt-4 border-warning d-none" id="helpCard">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            Consejos para Edición
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-warning">Consideraciones importantes:</h6>
                                <ul class="small text-muted">
                                    <li>Los cambios se aplican inmediatamente</li>
                                    <li>No se pueden crear relaciones duplicadas</li>
                                    <li>Verifica que los datos sean correctos antes de guardar</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-warning">¿Necesitas ayuda?</h6>
                                <p class="small text-muted">
                                    Si tienes dudas sobre qué usuario o rol seleccionar, consulta con el administrador del sistema.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Confirmar Acción
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="confirmBtn">Confirmar</button>
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
        let currentData = {};
        let originalData = {};
        let relationId = null;

        $(document).ready(function() {
            // Obtener ID de la URL (simulado)
            relationId = getRelationIdFromURL();
            
            if (!relationId) {
                showToast('ID de relación no encontrado', 'error');
                setTimeout(() => window.location.href = '/usuario-rol', 2000);
                return;
            }

            $('#relationId').text(`#${relationId}`);
            initializeComponents();
            loadData();
        });

        function getRelationIdFromURL() {
            // En una aplicación real, obtendrías esto de la URL
            // Por ejemplo: window.location.pathname.split('/').pop()
            return 1; // Simulado para demo
        }

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

            setupEventListeners();
        }

        async function loadData() {
            try {
                // Simular carga de datos
                await new Promise(resolve => setTimeout(resolve, 1000));

                // Cargar datos actuales de la relación (simulado)
                currentData = {
                    usuario_rol_id: relationId,
                    usuario_id: 1,
                    rol_id: 2
                };

                originalData = { ...currentData };

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
                updateCurrentInfo();
                showMainCard();

            } catch (error) {
                showToast('Error al cargar los datos', 'error');
                setTimeout(() => window.location.href = '/usuario-rol', 2000);
            }
        }

        function populateSelects() {
            // Llenar select de usuarios
            const usuarioSelect = $('#usuario_id');
            usuarioSelect.empty().append('<option value="">Seleccionar usuario...</option>');
            usuarios.forEach(usuario => {
                const selected = usuario.id == currentData.usuario_id ? 'selected' : '';
                usuarioSelect.append(`<option value="${usuario.id}" ${selected}>${usuario.nombre} (${usuario.email})</option>`);
            });

            // Llenar select de roles
            const rolSelect = $('#rol_id');
            rolSelect.empty().append('<option value="">Seleccionar rol...</option>');
            roles.forEach(rol => {
                const selected = rol.id == currentData.rol_id ? 'selected' : '';
                rolSelect.append(`<option value="${rol.id}" ${selected}>${rol.nombre} - ${rol.descripcion}</option>`);
            });

            // Actualizar Select2
            usuarioSelect.trigger('change.select2');
            rolSelect.trigger('change.select2');

            updatePreview();
        }

        function updateCurrentInfo() {
            const usuario = usuarios.find(u => u.id == currentData.usuario_id);
            const rol = roles.find(r => r.id == currentData.rol_id);

            $('#currentUsuario').text(usuario ? `${usuario.nombre} (ID: ${usuario.id})` : 'No encontrado');
            $('#currentRol').text(rol ? `${rol.nombre} (ID: ${rol.id})` : 'No encontrado');
            $('#lastModified').text(new Date().toLocaleString());
        }

        function showMainCard() {
            $('#loadingCard').addClass('d-none');
            $('#mainCard, #helpCard').removeClass('d-none');
        }

        function setupEventListeners() {
            // Actualizar vista previa cuando cambian las selecciones
            $('#usuario_id, #rol_id').on('change', function() {
                updatePreview();
                checkForChanges();
            });

            // Manejar envío del formulario
            $('#usuarioRolForm').on('submit', handleSubmit);
        }

        function updatePreview() {
            const usuarioId = $('#usuario_id').val();
            const rolId = $('#rol_id').val();
            
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
        }

        function checkForChanges() {
            const currentUsuarioId = parseInt($('#usuario_id').val());
            const currentRolId = parseInt($('#rol_id').val());
            
            const hasChanges = (currentUsuarioId !== originalData.usuario_id) || 
                              (currentRolId !== originalData.rol_id);

            const previewCard = $('#previewCard');
            const changeAlert = $('#changeAlert');
            const submitBtn = $('#submitBtn');
            
            if (hasChanges) {
                previewCard.removeClass('active').addClass('modified');
                submitBtn.prop('disabled', false);
                
                // Mostrar cambios específicos
                const changes = [];
                if (currentUsuarioId !== originalData.usuario_id) {
                    const oldUsuario = usuarios.find(u => u.id == originalData.usuario_id);
                    const newUsuario = usuarios.find(u => u.id == currentUsuarioId);
                    changes.push(`Usuario: ${oldUsuario?.nombre || 'N/A'} → ${newUsuario?.nombre || 'N/A'}`);
                    $('#previewUsuarioIcon').removeClass('text-muted').addClass('text-warning');
                }

                if (currentRolId !== originalData.rol_id) {
                    const oldRol = roles.find(r => r.id == originalData.rol_id);
                    const newRol = roles.find(r => r.id == currentRolId);
                    changes.push(`Rol: ${oldRol?.nombre || 'N/A'} → ${newRol?.nombre || 'N/A'}`);
                    $('#previewRolIcon').removeClass('text-muted').addClass('text-warning');
                }

                if (changes.length > 0) {
                    changeAlert.removeClass('alert-info').addClass('alert-warning').show();
                    $('#changeTitle').text('Cambios detectados:');
                    $('#changesList').html('<ul class="mb-0"><li>' + changes.join('</li><li>') + '</li></ul>');
                }
            } else {
                previewCard.removeClass('modified active');
                changeAlert.hide();
                submitBtn.prop('disabled', true);
                $('#previewUsuarioIcon, #previewRolIcon').removeClass('text-warning').addClass('text-muted');
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

                const response = await fetch(`/api/usuario-rol/${relationId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Relación usuario-rol actualizada correctamente', 'success');
                    
                    // Actualizar datos originales
                    originalData = { ...formData, usuario_rol_id: relationId };
                    updateCurrentInfo();
                    checkForChanges();
                    
                    // Redirigir después de un breve delay
                    setTimeout(() => {
                        window.location.href = '/usuario-rol';
                    }, 1500);
                } else {
                    showToast(data.message || 'Error al actualizar la relación', 'error');
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

        function confirmReset() {
            $('#confirmMessage').text('¿Está seguro que desea restablecer todos los campos a sus valores originales? Se perderán los cambios no guardados.');
            $('#confirmBtn').off('click').on('click', function() {
                resetToOriginal();
                bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
            });
            new bootstrap.Modal(document.getElementById('confirmModal')).show();
        }

        function resetToOriginal() {
            $('#usuario_id').val(originalData.usuario_id).trigger('change');
            $('#rol_id').val(originalData.rol_id).trigger('change');
            $('#usuarioRolForm').removeClass('was-validated');
            showToast('Valores restablecidos', 'info');
        }

        function cancelEdit() {
            if ($('#submitBtn').prop('disabled') === false) {
                $('#confirmMessage').text('Tiene cambios sin guardar. ¿Está seguro que desea salir sin guardar?');
                $('#confirmBtn').off('click').on('click', function() {
                    window.location.href = '/usuario-rol';
                });
                new bootstrap.Modal(document.getElementById('confirmModal')).show();
            } else {
                window.location.href = '/usuario-rol';
            }
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