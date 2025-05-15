@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')
    <form action="{{ route('usuarios.update', $usuario) }}" method="post" class="form-editar">
        @csrf
        @method('PUT')
        {{-- With prepend slot --}}
        <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="nombre usuario" label-class="text-lightblue"
            value="{{ $usuario->nombre }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input type="text" name="correo" label="Correo" placeholder="correo@gmail.com"
            label-class="text-lightblue" value="{{ $usuario->correo }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-solid fa-envelope text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-button type="submit" label="Actualizar" theme="primary" icon="fas fa-save" />
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.form-editar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Quieres editar este usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, editar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
@stop
