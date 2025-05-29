@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar usuarios</h1>
@stop

@section('content')
    @php
        $heads = ['ID', 'Nombre', 'Correo', 'Rol', ['label' => 'Acciones', 'no-export' => true, 'width' => 15]];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';

    @endphp

    <div class="card">
        <div class="card-body">
            <div class="my-3">
                <a href="{{ route('usuarios.create') }}">
                    <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-plus" class="float-right" data-toggle="modal"
                        data-target="#modalPurple" />
                </a>

                <a href="{{ route('usuarios.exportar.pdf') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="danger" icon="fas fa-file-pdf" label="pdf" />
                </a>

                <a href="{{ route('usuarios.exportar.csv') }}">
                    <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-file-csv"
                        label="csv" />
                </a>
            </div>
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ implode(', ', $usuario->getRoleNames()->toArray()) }}</td>
                        <td>
                            <a href="{{ route('usuarios.edit', $usuario) }}">
                                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            </a>
                            <form style="display : inline" action="{{ route('usuarios.destroy', $usuario) }}" method="POST"
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
