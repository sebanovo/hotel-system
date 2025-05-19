@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar Bitacora</h1>
@stop

@section('content')
    @php
        $heads = [
            'ID',
            'Usuario',
            'Correo',
            'IP',
            'Acción',
            'Fecha y Hora'
        ];
    @endphp

    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="tableBitacora" :heads="$heads" striped hoverable with-buttons>
                @foreach ($bitacoras as $bitacora)
                    <tr>
                        <td>{{ $bitacora->id }}</td>
                        <td>{{ $bitacora->user->name ?? 'Usuario eliminado' }}</td>
                        <td>{{ $bitacora->user->email ?? 'N/A' }}</td>
                        <td>{{ $bitacora->ip }}</td>
                        <td>{{ $bitacora->accion }}</td>
                        <td>{{ $bitacora->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.console.log('Hi, I\'m using the Laravel-AdminLTE package!');
    </script>
@stop
