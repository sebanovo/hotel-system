@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar reservas</h1>
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
            'Inicio',
            'Salida',
            'Estado',
            'Cliente',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
        ];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <a href="{{ route('reservas.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('reservas.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->id }}</td>
                        <td>{{ $reserva->fecha_inicio }}</td>
                        <td>{{ $reserva->fecha_salida }}</td>
                        <td>{{ $reserva->estado->nombre }}</td>
                        <td>{{ $reserva->cliente_users->name }}</td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdatereserva{{ $reserva->id }}" />
                            <x-adminlte-modal id="modalUpdatereserva{{ $reserva->id }}" title="Actualizar reserva"
                                theme="primary" icon="fas fa-bolt" size='lg' disable-animations>
                                <form action="{{ route('reservas.update', $reserva) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <x-adminlte-input name="estado" label="Estado" value="{{ $reserva->estado->id }}"
                                            fgroup-class="col-md-6" disable-feedback />
                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                </form>
                            </x-adminlte-modal>
                            <form style="display : inline" action="{{ route('reservas.destroy', $reserva) }}"
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
