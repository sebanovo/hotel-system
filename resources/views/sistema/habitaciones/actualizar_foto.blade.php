@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Habitacion {{ $habitacion->id }}</h1>
@stop

@section('content')
    @php
        $existeFoto =
            $habitacion->url_foto &&
            Storage::disk('public')->exists(str_replace('/storage/', '', $habitacion->url_foto));
    @endphp
    <img src="{{ $existeFoto ? $habitacion->url_foto : asset('images/fallbacks/habitacion-fallback.png') }}"
        class="img-thumbnail" style="width: 400px; height: 400px; object-fit: cover;"
        alt="{{ $existeFoto ? 'Foto de la habitacion' : 'Habitacion sin foto' }}">

    <form action="{{ route('habitaciones.updatePhoto', $habitacion->id) }}" method="POST" enctype="multipart/form-data"
        class="mt-3">
        @csrf
        @method('PUT')

        <div class="w-50">
            <x-adminlte-input-file name="habitacion_imagen" igroup-size="sm" placeholder="Selecciona una imagen"
                accept="image/*" required>
                <x-slot name="appendSlot">
                    <x-adminlte-button theme="primary" type="submit" label="Actualizar foto" />
                </x-slot>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
        </div>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop
