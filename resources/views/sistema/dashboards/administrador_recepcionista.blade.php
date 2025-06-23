@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-tools"></i> Panel de Administración</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-md-3">
            <x-adminlte-small-box title="Habitaciones" text="{{ $habitacionesCount }} registradas" icon="fas fa-bed text-white"
                theme="teal" url="{{ route('habitaciones.index') }}" url-text="Ver habitaciones" />
        </div>

        <div class="col-md-3">
            <x-adminlte-small-box title="Reservas activas" text="{{ $reservasActivasCount }} en curso" icon="fas fa-calendar-check text-white"
                theme="purple" url="{{ route('reservas.index') }}" url-text="Ver reservas" />
        </div>

        <div class="col-md-3">
            <x-adminlte-small-box title="Clientes" text="{{ $clientesCount }} registrados" icon="fas fa-users text-white"
                theme="info" url="{{ route('clientes.index') }}" url-text="Ver clientes" />
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <x-adminlte-card title="Próximas salidas" theme="warning" icon="fas fa-door-open">
                <ul class="list-group">
                    @forelse($proximasSalidas as $reserva)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Habitación #{{ $reserva->habitaciones->first()->nro ?? '-' }}
                            <span class="badge bg-warning text-dark">{{ \Carbon\Carbon::parse($reserva->fecha_salida)->format('d/m/Y') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item">No hay salidas próximas</li>
                    @endforelse
                </ul>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Estado general del hotel" theme="primary" icon="fas fa-chart-pie">
                <p><strong>Ocupación actual:</strong> {{ $ocupacionPorcentaje }}%</p>
                <p><strong>Habitaciones disponibles:</strong> {{ $habitacionesDisponibles }}</p>
                <p><strong>En mantenimiento:</strong> {{ $habitacionesMantenimiento }}</p>
            </x-adminlte-card>
        </div>

    </div>
@stop
