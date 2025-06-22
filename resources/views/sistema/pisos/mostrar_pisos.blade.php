@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar pisos</h1>
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
        $heads = ['#', 'Nombre', 'Descripcion', ['label' => 'Acciones', 'no-export' => true, 'width' => 15]];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';

    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-plus" class="float-right my-3" data-toggle="modal"
                    data-target="#modalPurple" />

                <a href="{{ route('pisos.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('pisos.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-modal id="modalPurple" title="Nuevo piso" theme="primary" icon="fas fa-bolt" size='lg'
                disable-animations>
                <form class="form-crear" action="{{ route('pisos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="nombre" label="Nombre" placeholder="nombre piso" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-input name="descripcion" label="Descripcion" placeholder="descripcion"
                            fgroup-class="col-md-6" disable-feedback />
                    </div>
                    <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />
                </form>
            </x-adminlte-modal>

            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($pisos as $piso)
                    <tr>
                        <td>{{ $piso->id }}</td>
                        <td>{{ $piso->nombre }}</td>
                        <td>{{ $piso->descripcion }}</td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdatepiso{{ $piso->id }}" />
                            <x-adminlte-modal id="modalUpdatepiso{{ $piso->id }}"
                                title="Actualizar piso {{ $piso->nro }}" theme="primary" icon="fas fa-bolt"
                                size='lg' disable-animations>
                                <form action="{{ route('pisos.update', $piso) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="column">
                                        <x-adminlte-input name="nombre" label="Nombre" placeholder="nombre"
                                            value="{{ $piso->nombre }}" fgroup-class="col-md-6" disable-feedback />
                                        <x-adminlte-input name="descripcion" label="Descripción" placeholder="Descripción"
                                            value="{{ $piso->descripcion }}" fgroup-class="col-md-6" disable-feedback />
                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                </form>
                            </x-adminlte-modal>
                            <form style="display : inline" action="{{ route('pisos.destroy', $piso) }}" method="POST"
                                class='form-eliminar'>
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
