@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de usuarios y roles</h1>
@stop

@section('content')
    @php
        $heads = ['ID', 'Nombre', 'Correo', 'Rol', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

    @endphp

    <div class="card">
        <div class="card-body">
            @role('Administrador')
                <div>
                    <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right my-3" data-toggle="modal"
                        data-target="#modalPurple"/>
                </div>
            @endrole
            <x-adminlte-datatable id="table1" :heads="$heads" class="card-body">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ implode(', ', $usuario->getRoleNames()->toArray())}}</td>

                        <td>
                            @role('Administrador')
                                <a href="{{ route('asignar.edit', $usuario) }}"><button
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button></a>
                            @endrole
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
