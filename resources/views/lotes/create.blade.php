@extends('layouts.app')

@section('title', 'Crear Nuevo Lote')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Crear Nuevo Lote
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('lotes.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Código de Lote -->
                        <div class="col-md-6 mb-3">
                            <label for="codigo_lote" class="form-label">
                                <i class="fas fa-barcode me-1"></i>Código de Lote *
                            </label>
                            <input type="text" class="form-control @error('codigo_lote') is-invalid @enderror" 
                                   id="codigo_lote" name="codigo_lote" value="{{ old('codigo_lote') }}" 
                                   placeholder="Ej: LOT-001" required>
                            @error('codigo_lote')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tipo de Cultivo -->
                        <div class="col-md-6 mb-3">
                            <label for="tipo_cultivo" class="form-label">
                                <i class="fas fa-seedling me-1"></i>Tipo de Cultivo *
                            </label>
                            <input type="text" class="form-control @error('tipo_cultivo') is-invalid @enderror" 
                                   id="tipo_cultivo" name="tipo_cultivo" value="{{ old('tipo_cultivo') }}" 
                                   placeholder="Ej: Maíz, Trigo, Soja" required>
                            @error('tipo_cultivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Variedad -->
                        <div class="col-md-6 mb-3">
                            <label for="variedad" class="form-label">
                                <i class="fas fa-leaf me-1"></i>Variedad
                            </label>
                            <input type="text" class="form-control @error('variedad') is-invalid @enderror" 
                                   id="variedad" name="variedad" value="{{ old('variedad') }}" 
                                   placeholder="Variedad del cultivo (opcional)">
                            @error('variedad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha de Cosecha -->
                        <div class="col-md-6 mb-3">
                            <label for="fecha_cosecha" class="form-label">
                                <i class="fas fa-calendar me-1"></i>Fecha de Cosecha *
                            </label>
                            <input type="date" class="form-control @error('fecha_cosecha') is-invalid @enderror" 
                                   id="fecha_cosecha" name="fecha_cosecha" value="{{ old('fecha_cosecha') }}" required>
                            @error('fecha_cosecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Cantidad en KG -->
                        <div class="col-md-6 mb-3">
                            <label for="cantidad_kg" class="form-label">
                                <i class="fas fa-weight me-1"></i>Cantidad (kg) *
                            </label>
                            <input type="number" step="0.01" min="0" 
                                   class="form-control @error('cantidad_kg') is-invalid @enderror" 
                                   id="cantidad_kg" name="cantidad_kg" value="{{ old('cantidad_kg') }}" 
                                   placeholder="0.00" required>
                            @error('cantidad_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Precio por KG -->
                        <div class="col-md-6 mb-3">
                            <label for="precio_kg" class="form-label">
                                <i class="fas fa-dollar-sign me-1"></i>Precio por KG
                            </label>
                            <input type="number" step="0.01" min="0" 
                                   class="form-control @error('precio_kg') is-invalid @enderror" 
                                   id="precio_kg" name="precio_kg" value="{{ old('precio_kg') }}" 
                                   placeholder="0.00">
                            @error('precio_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Ubicación de Origen -->
                    <div class="mb-3">
                        <label for="ubicacion_origen" class="form-label">
                            <i class="fas fa-map-marker-alt me-1"></i>Ubicación de Origen *
                        </label>
                        <input type="text" class="form-control @error('ubicacion_origen') is-invalid @enderror" 
                               id="ubicacion_origen" name="ubicacion_origen" value="{{ old('ubicacion_origen') }}" 
                               placeholder="Ej: Finca San José, Sector Norte" required>
                        @error('ubicacion_origen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Estado -->
                        <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label">
                                <i class="fas fa-flag me-1"></i>Estado *
                            </label>
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value="">Seleccionar estado</option>
                                <option value="cosechado" {{ old('estado') == 'cosechado' ? 'selected' : '' }}>Cosechado</option>
                                <option value="procesando" {{ old('estado') == 'procesando' ? 'selected' : '' }}>Procesando</option>
                                <option value="almacenado" {{ old('estado') == 'almacenado' ? 'selected' : '' }}>Almacenado</option>
                                <option value="entregado" {{ old('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Responsable -->
                        <div class="col-md-6 mb-3">
                            <label for="responsable" class="form-label">
                                <i class="fas fa-user me-1"></i>Responsable *
                            </label>
                            <input type="text" class="form-control @error('responsable') is-invalid @enderror" 
                                   id="responsable" name="responsable" value="{{ old('responsable') }}" 
                                   placeholder="Nombre del responsable" required>
                            @error('responsable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">
                            <i class="fas fa-comment me-1"></i>Observaciones
                        </label>
                        <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                                  id="observaciones" name="observaciones" rows="3" 
                                  placeholder="Observaciones adicionales (opcional)">{{ old('observaciones') }}</textarea>
                        @error('observaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('lotes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Volver
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Crear Lote
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Calcular valor total automáticamente
    document.addEventListener('DOMContentLoaded', function() {
        const cantidadInput = document.getElementById('cantidad_kg');
        const precioInput = document.getElementById('precio_kg');
        
        function calcularTotal() {
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const precio = parseFloat(precioInput.value) || 0;
            const total = cantidad * precio;
            
            // Mostrar total calculado (opcional)
            console.log('Valor total calculado: $' + total.toFixed(2));
        }
        
        cantidadInput.addEventListener('input', calcularTotal);
        precioInput.addEventListener('input', calcularTotal);
    });
</script>
@endsection