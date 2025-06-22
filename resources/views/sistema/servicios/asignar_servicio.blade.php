@extends('adminlte::page')

@section('title', 'Pedir Servicio')

@section('content_header')
    <h1>Catálogo de Servicios</h1>
@stop

@section('content')
    <h3 class="text-primary"><i class="fas fa-fw fa-concierge-bell"></i> Servicios Disponibles</h3>

    {{-- Selector de cliente --}}
    <form action="{{ route('servicios.asignar') }}" method="POST">
        @csrf
        <div class="form-group col-md-4">
            <label for="cliente_id">Seleccionar Cliente</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">-- Elija un cliente --</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                @endforeach
            </select>
        </div>

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

                            {{-- Botón con servicio_id oculto --}}
                            <input type="hidden" name="servicio_id" value="{{ $servicio->id }}">
                            <x-adminlte-button type="submit" theme="primary" label="Solicitar Servicio" />
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
    </form>
@stop
