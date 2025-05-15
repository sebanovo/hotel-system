@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mostrar usuarios</h1>
@stop

@section('content')
    @php
        $heads = ['ID', 'Nombre', 'Correo', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

        $btnEdit = '<a><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button></a>';
        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

        // $config = [
        //     'language' => [
        //         'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        //     ]
        // ]

    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    {{-- <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"> --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario)}}"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button></a>
                    {{-- {!! $btnEdit !!} --}}
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
