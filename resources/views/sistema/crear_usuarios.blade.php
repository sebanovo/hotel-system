@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear usuarios</h1>
@stop

@section('content')
    {{-- @php
            if(session()) {
                if(session('success')) {
                    echo '<x-adminlte-alert theme="success" title="Success!" dismissable>'
                }
            }    
    @endphp --}}
    <form action="{{ route('usuarios.store') }}" method="post">
        @csrf
        {{-- With prepend slot --}}
        <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="nombre usuario" label-class="text-lightblue" value="{{ old('nombre') }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input type="text" name="correo" label="Correo" placeholder="correo@gmail.com"
            label-class="text-lightblue" value="{{ old('correo') }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-solid fa-envelope text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input type="password" name="contraseña" label="Contraseña" placeholder="Contraseña123"
            label-class="text-lightblue" value="{{ old('contraseña') }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-solid fa-lock text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
