<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolAdministrador = Role::findByName('Administrador', 'sanctum');
        $rolRecepcionista = Role::findByName('Recepcionista', 'sanctum');
        $rolCliente = Role::findByName('Cliente', 'sanctum');

        $user1 = User::find(1);
        $user1->assignRole($rolAdministrador);

        $user2 = User::find(2);
        $user2->assignRole($rolRecepcionista);

        $user3 = User::find(3);
        $user3->assignRole($rolRecepcionista);

        $user4 = User::find(4);
        $user4->assignRole($rolCliente);

        $user4 = User::find(5);
        $user4->assignRole($rolCliente);
    }
}
