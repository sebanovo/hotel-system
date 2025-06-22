@extends('adminlte::page')

@section('title', 'Check-In')

@section('content_header')
    <h1 class="text-success"><i class="fas fa-door-open"></i> Habitaciones disponibles para Reservar</h1>
@stop

@section('content')
    <div class="row">
        @forelse ($habitaciones as $habitacion)
            <div class="col-md-4 mb-4">
                <div class="card border-success shadow h-100">
                    <div class="position-relative">
                        @php
                            $existeFoto =
                                $habitacion->url_foto &&
                                Storage::disk('public')->exists(str_replace('/storage/', '', $habitacion->url_foto));
                        @endphp
                        <img src="{{ $existeFoto ? $habitacion->url_foto : asset('images/fallbacks/habitacion-fallback.png') }}"
                            class="card-img-top" style="height: 180px; object-fit: cover;"
                            alt="{{ $existeFoto ? 'Foto de la habitacion' : 'Habitacion sin foto' }}">

                        <span class="badge bg-success position-absolute m-2 px-3 py-2 shadow-sm" style="top: 0; right: 0;">
                            {{ ucfirst($habitacion->estado->nombre) }}
                        </span>
                    </div>


                    <div class="card-body bg-light">
                        <h5 class="card-title text-success">
                            <i class="fas fa-bed"></i> Habitación #{{ $habitacion->nro }}
                        </h5>
                        </br>
                        <p class="mb-2">
                            <strong><i class="fas fa-layer-group text-muted"></i></strong>
                            {{ $habitacion->piso->nombre ?? 'N/A' }}
                        </p>
                        <p class="mb-2">
                            <strong><i class="fas fa-chair text-muted"></i> Artículos:</strong>
                            @if ($habitacion->detalle_habitacion && $habitacion->detalle_habitacion->isNotEmpty())
                                <ul class="mb-0">
                                    @foreach ($habitacion->detalle_habitacion as $detalle)
                                        @if ($detalle->articulos)
                                            <li>{{ $detalle->articulos->nombre }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">Sin artículos asignados</span>
                            @endif

                        </p>
                    </div>

                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('entradas.checkin', $habitacion->id) }}" class="btn btn-success btn-block">
                            <i class="fas fa-user-check"></i> Ingresar huésped
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No hay habitaciones disponibles para en este momento.
                </div>
            </div>
        @endforelse
    </div>
@stop