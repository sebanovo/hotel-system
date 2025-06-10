@extends('adminlte::page')

@section('title', 'Perfil de Usuario')

@section('content_header')
    <h1>Perfil de Usuario</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body text-center">
            @php
                $existeFoto =
                    $usuario->profile_photo_path &&
                    Storage::disk('public')->exists(str_replace('/storage/', '', $usuario->profile_photo_path));
            @endphp
            <img src="{{ $existeFoto ? $usuario->profile_photo_path : asset('images/fallbacks/usuario-fallback.png') }}"
                class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;"
                alt="{{ $existeFoto ? 'Foto del usuairo' : 'Usuario sin foto' }}">

            <form action="{{ route('usuarios.updatePhoto', $usuario->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-3">
                @csrf
                @method('PUT')

                <div class="w-50 mx-auto">
                    <x-adminlte-input-file name="profile_photo" igroup-size="sm" placeholder="Selecciona una foto"
                        accept="image/*" required>
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" type="submit" label="Actualizar foto" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </form>


            <div class="mb-3">
                <label class="form-label text-lightblue"><i class="fas fa-user text-lightblue"></i> Nombre</label>
                <p class="form-control-plaintext">{{ $usuario->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label text-lightblue"><i class="fas fa-envelope text-lightblue"></i> Correo</label>
                <p class="form-control-plaintext">{{ $usuario->email }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label text-lightblue"><i class="fas fa-user-tie text-lightblue"></i>Rol</label>
                <p class="form-control-plaintext">{{ implode(', ', $usuario->getRoleNames()->toArray()) }}</p>
            </div>

            <hr>
            <h4 class="text-left text-lightblue">Cambiar Contraseña</h4>

            <form action="{{ route('usuarios.cambiarPassword', $usuario->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')

                <x-adminlte-input type="password" name="actual_password" label="Contraseña Actual"
                    placeholder="Ingrese su contraseña actual" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-solid fa-lock text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input type="password" name="nueva_password" label="Nueva Contraseña"
                    placeholder="Ingrese su nueva contraseña" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-solid fa-lock text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input type="password" name="confirmar_password" label="Confirmar Contraseña"
                    placeholder="Repita su nueva contraseña" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-solid fa-lock text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-button type="submit" label="Actualizar Contraseña" theme="primary" icon="fas fa-key" />
            </form>
        </div>
    </div>
@stop
