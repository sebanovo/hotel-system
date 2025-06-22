@extends('adminlte::page')

@section('title', 'Crear Reserva')

@section('content_header')
    <h1>Reservar Habitación #{{ $habitacion->nro }}</h1>
@stop

@section('content')
    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <input type="hidden" name="habitacion_id" value="{{ $habitacion->id }}">

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Datos del Cliente</strong>
                    </div>
                    <div class="card-body">

                        <x-adminlte-select name="cliente_id" label="Seleccionar Cliente" igroup-size="sm" required>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-user"></i>
                                </div>
                            </x-slot>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">
                                    {{ $cliente->id }}
                                    {{ $cliente->name }} -
                                    {{ $cliente->email }}</option>
                            @endforeach
                        </x-adminlte-select>

                        <div class="text-muted mt-2">
                            ¿El cliente no existe? <a href="{{ route('usuarios.create') }}">Registrar nuevo cliente</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Sección Reserva -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <strong>Detalles de la Reserva</strong>
                    </div>
                    <div class="card-body">

                        <x-adminlte-input name="fecha_inicio" label="Fecha de ingreso" type="date" igroup-size="sm"
                            required />

                        <x-adminlte-input name="fecha_salida" label="Fecha de salida" type="date" igroup-size="sm"
                            required />

                        <x-adminlte-input name="monto" label="Monto a pagar (Bs)" type="number" step="0.01"
                            igroup-size="sm" value="{{ $habitacion->precio ?? '' }}" required disabled>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <div class="text-muted">
                            Precio por noche: <strong>{{ number_format($habitacion->precio, 2) }} Bs</strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <x-adminlte-button type="submit" label="Confirmar Reserva" theme="success" icon="fas fa-check" class="mt-3" />
    </form>
@stop
