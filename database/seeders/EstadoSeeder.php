<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado::create([
            'id' => 1,
            'nombre' => 'disponible',
            'descripcion' => 'El piso está disponible para ser reservado',
        ]);
        Estado::create([
            'id' => 2,
            'nombre' => 'reservado',
            'descripcion' => 'El piso ha sido reservado por un cliente',
        ]);
        Estado::create([
            'id' => 3,
            'nombre' => 'no disponible',
            'descripcion' => 'El piso no está disponible para ser reservado',
        ]);
        Estado::create([
            'id' => 4,
            'nombre' => 'en mantenimiento',
            'descripcion' => 'El piso está en mantenimiento y no puede ser reservado',
        ]);
    }
}
