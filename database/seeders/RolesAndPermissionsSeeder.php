<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'Gestionar usuarios', // Gestionar usuarios
            'Crear usuarios',
            'Leer usuarios',
            'Actualizar usuarios',
            'Eliminar usuarios',

            'Gestionar habitaciones', // Gestionar habitaciones
            'Crear habitaciones',
            'Leer habitaciones',
            'Actualizar habitaciones',
            'Eliminar habitaciones',

            'Administrar roles y permisos', // Administrar roles y permisos
            'Crear roles',
            'Leer roles',
            'Actualizar roles',
            'Eliminar roles',

            'Gestionar bitacoras', // Gestionar bitacoras

            'Crear permisos',
            'Leer permisos',
            'Actualizar permisos',
            'Eliminar permisos',

            'Gestionar reservas', // Gestionar reservas 
            'Crear reservas',
            'Leer reservas',
            'Actualizar reservas',
            'Eliminar reservas',

            'Gestionar servicios', // Gestionar servicios 
            'Crear servicios',
            'Leer servicios',
            'Actualizar servicios',
            'Eliminar servicios',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        $roles = [
            'Administrador' => [
                ...$permissions
            ],
            'Recepcionista' => [
                'Gestionar habitaciones', // Gestionar habitaciones
                'Crear habitaciones',
                'Leer habitaciones',
                'Actualizar habitaciones',
                'Eliminar habitaciones',

                'Gestionar servicios', // Gestionar servicios 
                'Crear servicios',
                'Leer servicios',
                'Actualizar servicios',
                'Eliminar servicios',
            ],
            'Cliente' => []
        ];

        foreach ($roles as $role => $permissions) {
            $r = Role::create(['name' => $role, 'guard_name' => 'sanctum']);
            if (!empty($permissions)) {
                $r->givePermissionTo($permissions);
            }
        }
        // $role->givePermissionTo(Permission::all());
    }
}
