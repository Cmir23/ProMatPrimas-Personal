@extends('layouts.app')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard - ProMatPrimas</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Estadísticas principales -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalLotes }}</h3>
                        <p>Total Lotes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="{{ route('lotes.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $lotesEntregados }}</h3>
                        <p>Lotes Entregados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="{{ route('lotes.index') }}?estado=entregado" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $lotesProcesando }}</h3>
                        <p>En Procesamiento</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <a href="{{ route('lotes.index') }}?estado=procesando" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ number_format($totalKg, 0) }}</h3>
                        <p>Total KG Producidos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-weight"></i>
                    </div>
                    <a href="{{ route('lotes.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios del Sistema</h3>
                    </div>
                    <div class="card-body">
                        <p>Total de usuarios registrados: <strong>{{ $totalUsuarios }}</strong></p>
                        <p>Fecha actual: <strong>{{ now()->format('d/m/Y') }}</strong></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Acciones Rápidas</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('lotes.create') }}" class="btn btn-success btn-block">
                            <i class="fas fa-plus"></i> Crear Nuevo Lote
                        </a>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-info btn-block">
                            <i class="fas fa-users"></i> Gestionar Usuarios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection