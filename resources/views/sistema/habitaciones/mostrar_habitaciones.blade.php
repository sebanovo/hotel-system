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
            'Foto',
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
                <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-plus" class="float-right my-3" data-toggle="modal"
                    data-target="#modalPurple" />
                <a href="{{ route('habitaciones.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('habitaciones.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-modal id="modalPurple" title="Nuevo habitacion" theme="primary" icon="fas fa-bolt" size='lg'
                disable-animations>
                <form class="form-crear" action="{{ route('habitaciones.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        @php
                            $pisoOptions = $pisos->pluck('nombre', 'id')->toArray();
                            $tipoOptions = $tipo_habitaciones->pluck('nombre', 'id')->toArray();
                            $estadoOptions = $estado_habitaciones->pluck('nombre', 'id')->toArray();
                        @endphp

                        <x-adminlte-input name="capacidad" label="Capacidad" placeholder="Capacidad" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-input name="precio" label="Precio" placeholder="100.0" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-select name="tipo" label="Tipo" igroup-size="sm">
                            <x-adminlte-options :options="$tipoOptions" value="{{ 0 }}" required />
                        </x-adminlte-select>
                        <x-adminlte-select name="piso" label="Piso" igroup-size="sm">
                            <x-adminlte-options :options="$pisoOptions" value="{{ 0 }}" required />
                        </x-adminlte-select>
                        <x-adminlte-select name="estado" label="Estado" igroup-size="sm">
                            <x-adminlte-options :options="$estadoOptions" value="{{ 0 }}" required />
                        </x-adminlte-select>
                    </div>
                    <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />
                </form>
            </x-adminlte-modal>
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($habitaciones as $habitacion)
                    <tr>
                        <td>{{ $habitacion->nro }}</td>
                        <td style="display:flex; justify-content: left; align-items: center;">
                            @php
                                $existeFoto =
                                    $habitacion->url_foto &&
                                    Storage::disk('public')->exists(
                                        str_replace('/storage/', '', $habitacion->url_foto),
                                    );
                            @endphp
                            <img src="{{ $existeFoto ? $habitacion->url_foto : asset('images/fallbacks/habitacion-fallback.png') }}"
                                class="img-thumbnail" style="max-width: 100px; max-height: 50px; object-fit: cover;"
                                alt="{{ $existeFoto ? 'Foto de la habitacion' : 'Habitacion sin foto' }}">

                        </td>
                        <td>{{ $habitacion->capacidad }}</td>
                        <td>{{ number_format($habitacion->precio, 2) }}</td>
                        <td>{{ $habitacion->piso->nombre }}</td>
                        <td>{{ $habitacion->tipo_habitacion->nombre }}</td>
                        @php
                            switch ($habitacion->estado->nombre) {
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
                            <span class="badge bg-{{ $color }}">{{ ucfirst($habitacion->estado->nombre) }}</span>
                        </td>
                        <td>
                            {{ $habitacion->detalle_habitacion->map(function ($detalle) {
                                    return str_replace(' ', '', $detalle->articulos->nombre);
                                })->implode(', ') }}
                        </td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdatehabitacion{{ $habitacion->id }}" />
                            <x-adminlte-modal id="modalUpdatehabitacion{{ $habitacion->id }}"
                                title="Actualizar habitacion {{ $habitacion->nro }}" theme="primary" icon="fas fa-bolt"
                                size='lg' disable-animations>
                                <form action="{{ route('habitaciones.update', $habitacion) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="column">
                                        {{-- Mostrar la foto del habitacion --}}
                                        @php
                                            $existeFoto =
                                                $habitacion->url_foto &&
                                                Storage::disk('public')->exists(
                                                    str_replace('/storage/', '', $habitacion->url_foto),
                                                );
                                        @endphp
                                        <img src="{{ $existeFoto ? $habitacion->url_foto : asset('images/fallbacks/habitacion-fallback.png') }}"
                                            class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;"
                                            alt="{{ $existeFoto ? 'Foto de la habitacion' : 'Habitacion sin foto' }}">

                                        <x-adminlte-input name="capacidad" label="Capacidad" placeholder="capacidad"
                                            value="{{ $habitacion->capacidad }}" fgroup-class="col-md-6"
                                            disable-feedback />
                                        <x-adminlte-input name="precio" label="Precio (Bs)" placeholder="precio (bs)"
                                            value="{{ $habitacion->precio }}" fgroup-class="col-md-6" disable-feedback />

                                        @php
                                            $pisoOptions = $pisos->pluck('nombre', 'id')->toArray();
                                            $tipoOptions = $tipo_habitaciones->pluck('nombre', 'id')->toArray();
                                            $estadoOptions = $estado_habitaciones->pluck('nombre', 'id')->toArray();
                                        @endphp

                                        <x-adminlte-select name="piso" label="Piso" igroup-size="sm">
                                            <x-adminlte-options :options="$pisoOptions" value="{{ $habitacion->estado->id }}"
                                                required />
                                        </x-adminlte-select>

                                        <x-adminlte-select name="tipo" label="Tipo" igroup-size="sm">
                                            <x-adminlte-options :options="$tipoOptions"
                                                value="{{ $habitacion->tipo_habitacion->id }}" required />
                                        </x-adminlte-select>

                                        <x-adminlte-select name="estado" label="Estado" igroup-size="sm">
                                            <x-adminlte-options :options="$estadoOptions" value="{{ $habitacion->estado->id }}"
                                                required />
                                        </x-adminlte-select>

                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                    <a href="{{ route('habitaciones.show', $habitacion) }}">
                                        <x-adminlte-button label="Actualizar foto" theme="success" icon="fas fa-image" />
                                    </a>
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
