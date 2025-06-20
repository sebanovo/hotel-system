@extends('adminlte::page')

@section('title', 'Catálogo de Habitaciones')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-hotel"></i> Catálogo de Habitaciones</h1>
@stop

@section('content')
    <div class="row">
        @forelse($habitaciones as $habitacion)
            @if ($habitacion->estado->nombre != 'disponible')
                @continue
            @endif
            <div class="col-md-4 mb-4">
                <div class="card border-primary shadow h-100">
                    <div class="position-relative">
                        @php
                            $existeFoto =
                                $habitacion->url_foto &&
                                Storage::disk('public')->exists(str_replace('/storage/', '', $habitacion->url_foto));
                        @endphp
                        <img src="{{ $existeFoto ? $habitacion->url_foto : asset('images/fallbacks/habitacion-fallback.png') }}"
                            class="card-img-top" style="height: 180px; object-fit: cover;"
                            alt="{{ $existeFoto ? 'Foto de la habitacion' : 'Habitacion sin foto' }}">

                        @php
                            switch ($habitacion->estado->nombre) {
                                case 'disponible':
                                    $color = 'success'; // verde
                                    break;
                                case 'reservado':
                                    $color = 'warning'; // amarillo
                                    break;
                                case 'no disponible':
                                    $color = 'danger'; // rojo
                                    break;
                                case 'en mantenimiento':
                                    $color = 'info'; // celeste
                                    break;
                                default:
                                    $color = 'secondary'; // gris
                            }
                        @endphp
                        <span class="badge bg-{{ $color }} position-absolute m-2 px-3 py-2 shadow-sm"
                            style="top: 0; right: 0;">
                            {{ ucfirst($habitacion->estado->nombre) }}
                        </span>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Habitación #{{ $habitacion->nro }}</h5>
                        <p class="card-text">
                            <strong>{{ $habitacion->piso->nombre ?? 'N/A' }}</strong><br>
                            <strong>Precio:</strong> {{ number_format($habitacion->precio, 2) }} Bs (noche)
                            <br>
                            <strong>Articulos:</strong>
                            {{ $habitacion->detalle_habitacion->map(function ($detalle) {
                                    return str_replace(' ', '', $detalle->articulos->nombre);
                                })->implode(', ') }}
                            <br>
                        </p>
                    </div>
                    <div class="p-3">
                        @if ($habitacion->estado->nombre === 'disponible')
                            <a href="{{ route('showHabitacion', $habitacion) }}">
                                <x-adminlte-button class="float-right" type="submit" theme="primary" label="Reservar" />
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle"></i> No hay habitaciones disponibles.
                </div>
            </div>
        @endforelse
    </div>
@stop
