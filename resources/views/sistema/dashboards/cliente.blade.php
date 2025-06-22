@extends('adminlte::page')

@section('title', 'Catálogo de Habitaciones y Servicios')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-hotel"></i>Catálogo de Habitaciones</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

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
                        <h5 class="card-title"><strong>Habitación</strong> #{{ $habitacion->nro }}</h5>
                        <p class="card-text">
                        <p><strong>Piso: </strong>{{ $habitacion->piso->id ?? 'N/A' }}</p>
                        <strong>Precio:</strong> {{ number_format($habitacion->precio, 2) }} Bs (noche)
                        <br>
                        <strong>Capacidad:</strong> {{ $habitacion->capacidad }} personas
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
    <h3 class="text-primary"><i class="fas fa-fw fa-concierge-bell"></i>Catálogo Servicios</h3>
    <div class="row">
        @forelse($servicios as $servicio)
            <div class="col-md-4 mb-4">
                <div class="card border-primary shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $servicio->nombre }}</strong></h5>
                        <p class="card-text">
                            <strong>Descripción:</strong> {{ $servicio->descripcion }}<br>
                            <strong>Precio:</strong> {{ number_format($servicio->precio, 2) }} Bs
                        </p>
                        <a href="{{ route('showServicio', $servicio) }}">
                            <x-adminlte-button class="float-right" type="submit" theme="primary"
                                label="Solicitar Servicio" />
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle"></i> No hay servicios disponibles.
                </div>
            </div>
        @endforelse
    </div>
@stop
