@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-boxes mr-2"></i>Gestión de Lotes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Lotes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <!-- Filtros de búsqueda -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-filter"></i> Filtros de Búsqueda
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('lotes.search') }}" method="GET" class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="codigo_lote">Código de Lote</label>
                            <input type="text" class="form-control" id="codigo_lote" name="codigo_lote" 
                                   value="{{ request('codigo_lote') }}" placeholder="Buscar por código...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_cultivo">Tipo de Cultivo</label>
                            <input type="text" class="form-control" id="tipo_cultivo" name="tipo_cultivo" 
                                   value="{{ request('tipo_cultivo') }}" placeholder="Buscar por cultivo...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="cosechado" {{ request('estado') == 'cosechado' ? 'selected' : '' }}>Cosechado</option>
                                <option value="procesando" {{ request('estado') == 'procesando' ? 'selected' : '' }}>Procesando</option>
                                <option value="almacenado" {{ request('estado') == 'almacenado' ? 'selected' : '' }}>Almacenado</option>
                                <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="d-block">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('lotes.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de lotes -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Lotes ({{ $lotes->total() ?? $lotes->count() }} registros)</h3>
                <div class="card-tools">
                    <a href="{{ route('lotes.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Lote
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                @if($lotes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle">
                            <thead>
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
                                    <td><strong class="text-primary">{{ $lote->codigo_lote }}</strong></td>
                                    <td>{{ $lote->tipo_cultivo }}</td>
                                    <td>{{ $lote->variedad ?? 'N/A' }}</td>
                                    <td>{{ $lote->fecha_cosecha->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ number_format($lote->cantidad_kg, 2) }} kg</span>
                                    </td>
                                    <td>
                                        @switch($lote->estado)
                                            @case('cosechado')
                                                <span class="badge badge-warning">Cosechado</span>
                                                @break
                                            @case('procesando')
                                                <span class="badge badge-primary">Procesando</span>
                                                @break
                                            @case('almacenado')
                                                <span class="badge badge-secondary">Almacenado</span>
                                                @break
                                            @case('entregado')
                                                <span class="badge badge-success">Entregado</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $lote->responsable }}</td>
                                    <td>
                                        @if($lote->precio_kg)
                                            <strong class="text-success">
                                                ${{ number_format($lote->cantidad_kg * $lote->precio_kg, 2) }}
                                            </strong>
                                        @else
                                            <span class="text-muted">Sin precio</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('lotes.show', $lote) }}" 
                                               class="btn btn-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('lotes.edit', $lote) }}" 
                                               class="btn btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('lotes.destroy', $lote) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este lote?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Eliminar">
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
                    @if(method_exists($lotes, 'links'))
                    <div class="card-footer clearfix">
                        {{ $lotes->withQueryString()->links() }}
                    </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No se encontraron lotes</h5>
                        <p class="text-muted">Comienza creando tu primer lote de producción.</p>
                        <a href="{{ route('lotes.create') }}" class="btn btn-success">
                            <i class="fas fa-plus mr-1"></i>Crear Primer Lote
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection