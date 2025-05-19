@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administrar roles</h1>
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
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role) }}"><button
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button></a>
                            <form style="display : inline" action="{{ route('roles.destroy', $role) }}" method="POST"
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
            <x-adminlte-modal id="modalPurple" title="Nuevo rol" theme="primary" icon="fas fa-bolt" size='lg'
                disable-animations>
                <form class="form-crear" action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="nombre" label="Nombre" placeholder="nombre rol" fgroup-class="col-md-6"
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
                    text: "¡Crear un nuevo rol!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, crear rol!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
@stop
