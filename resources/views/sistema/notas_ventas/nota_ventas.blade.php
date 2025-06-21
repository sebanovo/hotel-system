@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar notaventas</h1>
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
        $heads = [
            '#',
            'Fecha',
            'Monto',
            'Cliente',
            'Correo',
        ];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <a href="{{ route('notaventas.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('notaventas.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($notaventas as $notaventa)
                    <tr>
                        <td>{{ $notaventa->id }}</td>
                        <td>{{ $notaventa->fecha }}</td>
                        <td>{{ $notaventa->monto_total }}</td>
                        <td>{{ $notaventa->cliente->name }}</td>
                        <td>{{ $notaventa->cliente->email }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
