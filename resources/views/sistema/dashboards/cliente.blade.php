@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cliente</h1>
@stop

@section('content')
    <p>Hola soy cliente</p>
@stop

@section('css')
    {{-- Puedes incluir estilos adicionales si cada dashboard lo necesita --}}
@stop

@section('js')
    <script>
        console.log("Dashboard cargado según el rol.");
    </script>
@stop
