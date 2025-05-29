@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar servicios</h1>
@stop

@section('content')
    @php
        $heads = [
            '#',
            'Nombre',
            'Descripcion',
            'Precio (Bs)',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
        ];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    {{-- <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"> --}}
    <div class="card">
        <div class="card-body">
            <div>
                <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-plus" class="float-right my-3" data-toggle="modal"
                    data-target="#modalPurple" />
            </div>
            <x-adminlte-modal id="modalPurple" title="Nuevo servicio" theme="primary" icon="fas fa-bolt" size='lg'
                disable-animations>
                <form class="form-crear" action="{{ route('servicios.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="nombre" label="Nombre" placeholder="nombre servicio" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-input name="descripcion" label="Descripcion" placeholder="descripcion" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-input name="precio" label="Precio" placeholder="100.0" fgroup-class="col-md-6"
                            disable-feedback />
                    </div>
                    <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />
                </form>
            </x-adminlte-modal>
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id }}</td>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>{{ number_format($servicio->precio, 2) }}</td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdateservicio{{ $servicio->id }}" />
                            <x-adminlte-modal id="modalUpdateservicio{{ $servicio->id }}" title="Actualizar servicio"
                                theme="primary" icon="fas fa-bolt" size='lg' disable-animations>
                                <form action="{{ route('servicios.update', $servicio) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <x-adminlte-input name="nombre" label="Precio (Bs)" value="{{ $servicio->nombre }}"
                                            fgroup-class="col-md-6" disable-feedback />
                                        <x-adminlte-input name="descripcion" label="Descripcion" fgroup-class="col-md-6"
                                            disable-feedback value="{{ $servicio->descripcion }}" />
                                        <x-adminlte-input name="precio" label="Precio" fgroup-class="col-md-6"
                                            disable-feedback value="{{ number_format($servicio->precio, 2) }}" />
                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                </form>
                            </x-adminlte-modal>
                            <form style="display : inline" action="{{ route('servicios.destroy', $servicio) }}"
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
