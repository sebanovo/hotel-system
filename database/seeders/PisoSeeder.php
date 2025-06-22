<?php

namespace Database\Seeders;

use App\Models\Piso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Piso::create([
            'id' => 1,
            'nombre' => 'Piso 1',
            'descripcion' => 'piso con habitaciones del primer piso',
        ]);
        Piso::create([
            'id' => 2,
            'nombre' => 'Piso 2',
            'descripcion' => 'piso con habitaciones del segundo piso',
        ]);
        Piso::create([
            'id' => 3,
            'nombre' => 'Piso 3',
            'descripcion' => 'piso con habitaciones del tercer piso',
        ]);
        Piso::create([
            'id' => 4,
            'nombre' => 'Piso 4',
            'descripcion' => 'piso con habitaciones del cuarto piso',
        ]);
        Piso::create([
            'id' => 5,
            'nombre' => 'Piso 5',
            'descripcion' => 'piso con habitaciones del quinto piso',
        ]);
        Piso::create([
            'id' => 6,
            'nombre' => 'Piso 6',
            'descripcion' => 'piso con habitaciones del sexto piso',
        ]);
        Piso::create([
            'id' => 7,
            'nombre' => 'Piso 7',
            'descripcion' => 'piso con habitaciones del séptimo piso',
        ]);
        Piso::create([
            'id' => 8,
            'nombre' => 'Piso 8',
            'descripcion' => 'piso con habitaciones del octavo piso',
        ]);
    }
}
