@extends('adminlte::page')

@section('title', 'Reporte de Reservas')

@section('content_header')
    <h1 class="text-primary">Reportes</h1>
@stop

@section('content')
    <h4>Reservas</h4>
    <form action="{{ route('reportes.reservas.exportar') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>

        <div class="col-md-4">
            @php
                $estados_reservas = $estados->pluck('nombre', 'id')->toArray();
            @endphp
            <x-adminlte-select name="estado" label="Estado" igroup-size="sm">
                <x-adminlte-options :options="$estados_reservas" value="{{ 1 }}" required />
            </x-adminlte-select>
        </div>
        <div class="col-md-4 gap-2">
            <button type="submit" name="formato" value="csv" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Descargar CSV
            </button>

            <button type="submit" name="formato" value="pdf" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </button>
        </div>
    </form>
    <br>
    <br>
    <br>


    <h4>Habitaciones</h4>
    <form action="{{ route('reportes.habitaciones.exportar') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            @php
                $estados_reservas = $estados->pluck('nombre', 'id')->toArray();
            @endphp
            <x-adminlte-select name="estado" label="Estado" igroup-size="sm">
                <x-adminlte-options :options="$estados_reservas" value="{{ 1 }}" required />
            </x-adminlte-select>
            <button type="submit" name="formato" value="csv" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Descargar CSV
            </button>

            <button type="submit" name="formato" value="pdf" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </button>
        </div>
    </form>
@stop
