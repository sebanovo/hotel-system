@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar habitaciones</h1>
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
            'Capacidad',
            'Precio (Bs)',
            'Piso',
            'Tipo',
            'Estado',
            'Articulos',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
        ];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <a href="{{ route('habitaciones.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('habitaciones.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($habitaciones as $habitacion)
                    <tr>
                        <td>{{ $habitacion->nro }}</td>
                        <td>{{ $habitacion->capacidad }}</td>
                        <td>{{ number_format($habitacion->precio, 2) }}</td>
                        <td>{{ $habitacion->piso->nombre }}</td>
                        <td>{{ $habitacion->tipo_habitacion->nombre }}</td>
                        <td>{{ $habitacion->estado->nombre }}</td>
                        <td>
                            {{ $habitacion->detalle_habitacion->map(function ($detalle) {
                                    return str_replace(' ', '', $detalle->articulos->nombre);
                                })->implode(', ') }}
                        </td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdatehabitacion{{ $habitacion->id }}" />
                            <x-adminlte-modal id="modalUpdatehabitacion{{ $habitacion->id }}" title="Actualizar habitacion"
                                theme="primary" icon="fas fa-bolt" size='lg' disable-animations>
                                <form action="{{ route('habitaciones.update', $habitacion) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <x-adminlte-input name="precio" label="Precio (Bs)" placeholder="precio (bs)"
                                            value="{{ $habitacion->precio }}" fgroup-class="col-md-6" disable-feedback />
                                        <x-adminlte-input name="tipo_habitacion" label="Tipo Habitacion"
                                            fgroup-class="col-md-6" disable-feedback
                                            value="{{ $habitacion->tipo_habitacion_id }}" />
                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                </form>
                            </x-adminlte-modal>
                            <form style="display : inline" action="{{ route('habitaciones.destroy', $habitacion) }}"
                                method="POST" class='form-eliminar'>
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                        </td>
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
        $(document).ready(function() {
            $('.form-eliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
@stop
