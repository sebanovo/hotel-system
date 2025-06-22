@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Reservar Habitacion</h1>
@stop

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('reservarHabitacion') }}" method="POST">
        @csrf

        <input type="hidden" name="habitacion_id" value="{{ $habitacion->id }}">

        <div class="row">
            <!-- Fechas -->
            <div class="col-md-3">
                <x-adminlte-input name="fecha_inicio" label="Fecha de ingreso" type="date" igroup-size="sm" required />
            </div>
            <div class="col-md-3">
                <x-adminlte-input name="fecha_salida" label="Fecha de salida" type="date" igroup-size="sm" required />
            </div>

            <!-- Monto -->
            <div class="col-md-2 mt-3">
                <div class="text-muted">
                    Precio por noche: <strong>{{ number_format($habitacion->precio, 2) }} Bs</strong>
                </div>
            </div>
        </div>

        <x-adminlte-button type="submit" label="Reservar habitación" theme="success" icon="fas fa-check" class="mt-4" />
    </form>
@endsection
