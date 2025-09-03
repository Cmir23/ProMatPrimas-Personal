@extends('layouts.app')

@section('title', 'Lista de Lotes')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-boxes me-2"></i>Gestión de Lotes
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('lotes.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>Nuevo Lote
        </a>
    </div>
</div>

<!-- Filtros de búsqueda -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('lotes.search') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label for="codigo_lote" class="form-label">Código de Lote</label>
                <input type="text" class="form-control" id="codigo_lote" name="codigo_lote" 
                       value="{{ request('codigo_lote') }}" placeholder="Buscar por código...">
            </div>
            <div class="col-md-3">
                <label for="tipo_cultivo" class="form-label">Tipo de Cultivo</label>
                <input type="text" class="form-control" id="tipo_cultivo" name="tipo_cultivo" 
                       value="{{ request('tipo_cultivo') }}" placeholder="Buscar por cultivo...">
            </div>
            <div class="col-md-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="">Todos los estados</option>
                    <option value="cosechado" {{ request('estado') == 'cosechado' ? 'selected' : '' }}>Cosechado</option>
                    <option value="procesando" {{ request('estado') == 'procesando' ? 'selected' : '' }}>Procesando</option>
                    <option value="almacenado" {{ request('estado') == 'almacenado' ? 'selected' : '' }}>Almacenado</option>
                    <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-search"></i> Buscar
                </button>
                <a href="{{ route('lotes.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de lotes -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Lista de Lotes ({{ $lotes->total() }} registros)</h5>
    </div>
    <div class="card-body">
        @if($lotes->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>Código</th>
                            <th>Cultivo</th>
                            <th>Variedad</th>
                            <th>Fecha Cosecha</th>
                            <th>Cantidad (kg)</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th>Valor Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lotes as $lote)
                        <tr>
                            <td>
                                <strong class="text-primary">{{ $lote->codigo_lote }}</strong>
                            </td>
                            <td>{{ $lote->tipo_cultivo }}</td>
                            <td>{{ $lote->variedad ?? 'N/A' }}</td>
                            <td>{{ $lote->fecha_cosecha->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-info">{{ number_format($lote->cantidad_kg, 2) }} kg</span>
                            </td>
                            <td>
                                @switch($lote->estado)
                                    @case('cosechado')
                                        <span class="badge bg-warning">Cosechado</span>
                                        @break
                                    @case('procesando')
                                        <span class="badge bg-primary">Procesando</span>
                                        @break
                                    @case('almacenado')
                                        <span class="badge bg-secondary">Almacenado</span>
                                        @break
                                    @case('entregado')
                                        <span class="badge bg-success">Entregado</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $lote->responsable }}</td>
                            <td>
                                @if($lote->precio_kg)
                                    <strong class="text-success">
                                        ${{ number_format($lote->valor_total, 2) }}
                                    </strong>
                                @else
                                    <span class="text-muted">Sin precio</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('lotes.show', $lote) }}" 
                                       class="btn btn-outline-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lotes.edit', $lote) }}" 
                                       class="btn btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lotes.destroy', $lote) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este lote?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-3">
                {{ $lotes->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No se encontraron lotes</h5>
                <p class="text-muted">Comienza creando tu primer lote de producción.</p>
                <a href="{{ route('lotes.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Crear Primer Lote
                </a>
            </div>
        @endif
    </div>
</div>
@endsection