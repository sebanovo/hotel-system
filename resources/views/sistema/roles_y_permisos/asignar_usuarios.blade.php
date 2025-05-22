@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de usuarios y roles</h1>
@stop

@section('content')
    @php
        $heads = ['ID', 'Nombre', 'Correo', 'Rol', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];
    @endphp

    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" class="card-body">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ implode(', ', $usuario->getRoleNames()->toArray()) }}</td>

                        <td>
                            <a href="{{ route('asignar.edit', $usuario) }}"><button
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button></a>
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
        console.log('Hi, I\'m using the Laravel-AdminLTE package!');
    </script>
@stop
