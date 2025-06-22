@extends('adminlte::page')

@section('title', 'Pedir Servicio')

@section('content_header')
    <h1>Pedir Servicio: {{ $servicio->nombre }}</h1>
@stop

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-3">Detalles del Servicio</h4>
            <p><strong>Nombre:</strong> {{ $servicio->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $servicio->descripcion }}</p>
            <p><strong>Precio:</strong> Bs {{ number_format($servicio->precio, 2) }}</p>
        </div>
    </div>

    <div class="card shadow mt-4">
        <div class="card-body">
            <h4 class="mb-3">Información de Pago</h4>
            <form action="{{ route('comprarServicio', $servicio->id) }}" method="POST">
                <form>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_tarjeta" class="form-label">Nombre en la tarjeta</label>
                            <input type="text" class="form-control" name="nombre_tarjeta" required
                                placeholder="Juan Pérez">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="numero_tarjeta" class="form-label">Número de tarjeta</label>
                            <input type="text" class="form-control" name="numero_tarjeta" maxlength="19" required
                                placeholder="0000 0000 0000 0000">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="expiracion" class="form-label">Fecha de expiración</label>
                            <input type="text" class="form-control" name="expiracion" required placeholder="MM/AA">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" name="cvv" maxlength="4" required
                                placeholder="123">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="monto" class="form-label">Monto a pagar</label>
                            <input type="text" class="form-control" name="monto" value="{{ $servicio->precio }}"
                                readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-credit-card"></i> Pagar Servicio
                    </button>
                </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Formulario de pago cargado.");
    </script>
@stop
