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
            'Habitación',
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
                        @php
                            switch ($reserva->estado->nombre) {
                                case 'disponible':
                                    $color = 'success'; // verde
                                    break;
                                case 'reservado':
                                    $color = 'warning'; // amarillo
                                    break;
                                case 'no disponible':
                                    $color = 'danger'; // rojo
                                    break;
                                case 'en mantenimiento':
                                    $color = 'info'; // celeste
                                    break;
                                case 'finalizado':
                                    $color = 'dark'; // gris oscuro
                                    break;
                                default:
                                    $color = 'secondary'; // gris
                            }
                        @endphp
                        <td>
                            <span class="badge bg-{{ $color }}">{{ ucfirst($reserva->estado->nombre) }}</span>
                        </td>
                        <td>{{ $reserva->cliente_users->name }}</td>
                        <td>
                            @foreach ($reserva->habitaciones as $habitacion)
                                <span class="badge bg-info text-dark">{{ $habitacion->nro }}</span>
                            @endforeach
                        </td>
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
                                        @php
                                            $estados_reservas = $estados->pluck('nombre', 'id')->toArray();
                                        @endphp
                                        <x-adminlte-select name="estado" label="Estado" igroup-size="sm">
                                            <x-adminlte-options :options="$estados_reservas" :selected="$reserva->estado->id" required />
                                        </x-adminlte-select>
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
