@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administrar permisos</h1>
@stop

@section('content')
    @php
        $heads = ['ID', 'Nombre', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

    @endphp

    <div class="card">
        <div class="card-body">
            <div>
                <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right my-3" data-toggle="modal"
                    data-target="#modalPurple" />
            </div>
            <x-adminlte-datatable id="table1" :heads="$heads" class="card-body">
                @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->id }}</td>
                        <td>{{ $permiso->name }}</td>
                        <td>
                            <x-adminlte-button label="" theme="primary" icon="fa fa-lg fa-fw fa-pen"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" data-toggle="modal"
                                data-target="#modalUpdatePermiso{{ $permiso->id }}" />
                            <x-adminlte-modal id="modalUpdatePermiso{{ $permiso->id }}" title="Actualizar permiso"
                                theme="primary" icon="fas fa-bolt" size='lg' disable-animations>
                                <form action="{{ route('permisos.update', $permiso) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <x-adminlte-input name="nombre" label="Nombre" placeholder="nombre permiso"
                                            fgroup-class="col-md-6" disable-feedback />
                                    </div>
                                    <x-adminlte-button type="submit" label="Actualizar" theme="primary"
                                        icon="fas fa-save" />
                                </form>
                            </x-adminlte-modal>
                            <form style="display : inline" action="{{ route('permisos.destroy', $permiso) }}" method="POST"
                                class='form-eliminar'>
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            {{-- Themed --}}
            <x-adminlte-modal id="modalPurple" title="Nuevo permiso" theme="primary" icon="fas fa-bolt" size='lg'
                disable-animations>
                <form class="form-crear" action="{{ route('permisos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="nombre" label="Nombre" placeholder="nombre permiso" fgroup-class="col-md-6"
                            disable-feedback />
                    </div>
                    <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />
                </form>
            </x-adminlte-modal>

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
            $('.form-crear').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Crear un nuevo permiso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, crear permiso!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
@stop
