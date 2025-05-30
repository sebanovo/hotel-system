@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar Bitacora</h1>
@stop

@section('content')
    @php
        $config = [
            'language' => [
                'lengthMenu' => 'Mostrar _MENU_ registros por página',
                'zeroRecords' => 'No se encontraron resultados',
                'info' => 'Mostrando página _PAGE_ de _PAGES_',
                'infoEmpty' => 'No hay registros disponibles',
                'infoFiltered' => '(filtrados de _MAX_ registros totales)',
                'search' => 'Buscar:',
                'paginate' => [
                    'first' => 'Primera',
                    'last' => 'Última',
                    'next' => 'Siguiente',
                    'previous' => 'Anterior',
                ],
            ],
        ];
        $heads = ['ID', 'Usuario', 'Correo', 'IP', 'Acción', 'Fecha y Hora'];
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <a href="{{ route('bitacora.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('bitacora.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-datatable id="tableBitacora" :heads="$heads" striped hoverable with-buttons :config="$config">
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
