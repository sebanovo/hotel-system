@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Habitacion {{ $habitacion->id }}</h1>
@stop

@section('content')
    @if ($habitacion->url_foto && Storage::disk('public')->exists(str_replace('/storage/', '', $habitacion->url_foto)))
        <img src="{{ $habitacion->url_foto }}" class="img-thumbnail mb-3"
            style="width: 150px; height: 150px; object-fit: cover;" alt="Foto del habitacion">
    @else
        <img src="{{ asset('images/fallback.png') }}" class="img-thumbnail"
            style="max-width: 300px; max-height: 300; object-fit: cover;" alt="habitacion sin foto">
    @endif

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
