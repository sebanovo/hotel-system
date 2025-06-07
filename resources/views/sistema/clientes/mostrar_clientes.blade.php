@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar clientes</h1>
@stop

@section('content')
    @php
        $heads = ['ID', 'Nombre', 'Correo', ['label' => 'Acciones', 'no-export' => true, 'width' => 15]];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';

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

    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-plus" class="float-right" data-toggle="modal"
                    data-target="#modalPurple" />

                <a href="{{ route('clientes.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('clientes.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-modal id="modalPurple" title="Nuevo cliente" theme="primary" icon="fas fa-bolt" size='lg'
                disable-animations>
                <form class="form-crear" action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="name" label="Nombre" placeholder="nombre cliente" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-input name="email" label="Correo" placeholder="correo@example.com"
                            fgroup-class="col-md-6" disable-feedback />
                        <x-adminlte-input name="password" label="Contraseña" placeholder="contraseña"
                            fgroup-class="col-md-6" disable-feedback />
                    </div>
                    <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />
                </form>
            </x-adminlte-modal>
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdatecliente{{ $cliente->id }}" />

                            <x-adminlte-modal id="modalUpdatecliente{{ $cliente->id }}" title="Actualizar cliente"
                                theme="primary" icon="fas fa-bolt" size='lg' disable-animations>
                                <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        {{-- <x-adminlte-input name="name" label="Nombre" placeholder="nombre cliente"
                                            fgroup-class="col-md-6" disable-feedback />
                                        <x-adminlte-input name="email" label="Correo" placeholder="correo@example.com"
                                            fgroup-class="col-md-6" disable-feedback />
                                        <x-adminlte-input name="password" label="Contraseña" placeholder="contraseña"
                                            fgroup-class="col-md-6" disable-feedback /> --}}

                                        <x-adminlte-input name="name" label="Nombre" value="{{ $cliente->name }}"
                                            fgroup-class="col-md-6" disable-feedback />
                                        <x-adminlte-input name="email" label="Correo" fgroup-class="col-md-6"
                                            disable-feedback value="{{ $cliente->email }}" />
                                        <x-adminlte-input type="password" name="password" label="Contraseña"
                                            fgroup-class="col-md-6" disable-feedback value="{{ $cliente->password }}" />
                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                </form>
                            </x-adminlte-modal>

                            <form style="display : inline" action="{{ route('clientes.destroy', $cliente) }}"
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
