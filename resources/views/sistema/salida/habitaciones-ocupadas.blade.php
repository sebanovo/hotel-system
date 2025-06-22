@extends('adminlte::page')

@section('title', 'Check-Out')

@section('content_header')
    <h1 class="text-warning"><i class="fas fa-door-closed"></i> Reservas ocupadas para Desocupar</h1>
@stop

@section('content')
    <div class="row">
        @foreach ($reservas as $reserva)
            @foreach ($reserva->detalle_reservas as $detalle)
                @php
                    $habitacion = $detalle->habitacion;
                    $foto = $habitacion->url_foto ?? null;
                    $existeFoto = $foto && Storage::disk('public')->exists(str_replace('/storage/', '', $foto));
                @endphp

                <div class="col-md-4 mb-4">
                    <div class="card border-warning shadow h-100">
                        <div class="position-relative">
                            <img src="{{ $existeFoto ? $foto : asset('images/fallbacks/habitacion-fallback.png') }}"
                                class="card-img-top" style="height: 180px; object-fit: cover;"
                                alt="Habitación {{ $habitacion->nro }}">

                            <span class="badge bg-warning position-absolute m-2 px-3 py-2 shadow-sm"
                                style="top: 0; right: 0;">
                                {{ ucfirst($reserva->estado->nombre) }}
                            </span>
                        </div>

                        <div class="card-body bg-light">
                            <h5 class="card-title text-warning">
                                <i class="fas fa-bed"></i> Habitación #{{ $habitacion->nro }}
                            </h5>
                            <br>
                            <p class="mb-2"><strong><i class="fas fa-user text-muted"></i> Cliente:</strong>
                                {{ $reserva->cliente->name ?? 'Sin cliente' }}</p>
                            <p class="mb-2"><strong><i class="fas fa-layer-group text-muted"></i> Piso:</strong>
                                {{ $habitacion->piso->nombre ?? 'N/A' }}</p>
                            <p class="mb-2"><strong><i class="fas fa-calendar-alt text-muted"></i> Fecha inicio:</strong>
                                {{ $reserva->fecha_inicio }}</p>
                            <p class="mb-2"><strong><i class="fas fa-calendar-alt text-muted"></i> Fecha salida:</strong>
                                {{ $reserva->fecha_salida }}</p>
                        </div>

                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('salidas.checkout', $reserva->id) }}" class="btn btn-warning btn-block">
                                <i class="fas fa-sign-out-alt"></i> Finalizar Recepción
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>
@stop
